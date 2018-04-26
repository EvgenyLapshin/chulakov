var $ = require('gulp-load-plugins')();
var argv = require('yargs').argv;
var gulp = require('gulp');
var rimraf = require('rimraf');
var cleanCSS = require('gulp-clean-css');
var sherpa = require('style-sherpa');
var sequence = require('run-sequence');
var zip = require('gulp-zip');
var config = require('./package.json');

var ISPRODUCTION = !!(argv.production);
var BOWERPATH = 'bower_components';
var NPMRPATH = 'node_modules';
var DISTPATH = 'www/dist';
var SUFFIXMIN = ISPRODUCTION ? '.min' : '';

var COMPATIBILITY = ['last 2 versions', 'ie >= 9'];

var PATHS = {
    assets: [
        'src/**/*',
        'src/**/**/*',
        'src/**/**/**/*',
        '!src/{img,js,scss}/**/*',
        '!src/scss'
    ],
    sass: [
        'src/scss/*.scss',
        'src/scss/**/*.scss',
        'src/scss/**/**/*.scss'
    ],
    js: [
        'src/js/*.js',
        'src/js/**/*.js',
        'src/js/**/**/*.js'
    ],
    img: [
        'src/img/*',
        'src/img/**/*',
        'src/img/**/**/*'
    ],
    jsCore: [
        BOWERPATH + '/jquery/dist/jquery' + SUFFIXMIN + '.js',
        BOWERPATH + '/foundation-sites/dist/foundation' + SUFFIXMIN + '.js',
        BOWERPATH + '/select2/dist/js/select2.js',
        BOWERPATH + '/what-input/what-input' + SUFFIXMIN + '.js',
        BOWERPATH + '/jQuery.dotdotdot/src/jquery.dotdotdot' + SUFFIXMIN + '.js',
        NPMRPATH + '/js-cookie/src/js.cookie.js',
        'src/js/simple-cart.js',
        'src/js/cart-api.js',
        'src/js/jquery.tools.js',
        'src/js/jquery.ajax-post-loading.js',
        'src/js/jquery.maskedinput.js',
        'src/js/form.js'
    ],
    archive: [
        './**/*',
        '!www/assets',
        '!www/assets/**/*',
        '!www/uploads',
        '!www/uploads/**/*',
        '!archives',
        '!archives/**/',
        '!bower_components',
        '!bower_components/**/*',
        '!node_modules',
        '!node_modules/**/*',
        '!src',
        '!src/**/*',
        '!bower.json',
        '!package.json',
        '!gulpfile.js'
    ]

};

gulp.task('clean', function (done) {
    rimraf(DISTPATH, done);
});

gulp.task('copy', function () {
    gulp.src([
        BOWERPATH + '/mark.js/dist/jquery.mark.js',
        BOWERPATH + '/slick-carousel/slick/slick.js',
        BOWERPATH + '/progressbar.js/dist/progressbar.js'
    ]).pipe(gulp.dest(DISTPATH + '/js'));
    return gulp.src(PATHS.assets)
        .pipe(gulp.dest(DISTPATH));
});

gulp.task('sass', function () {
    return gulp.src('src/scss/style.scss')
        .pipe($.sourcemaps.init())
        .pipe($.sass({
            includePaths: PATHS.sass
        })
            .on('error', $.sass.logError))
        .pipe($.autoprefixer({
            browsers: COMPATIBILITY
        }))
        .pipe(cleanCSS({COMPATIBILITY: 'ie9', keepSpecialComments: 1}))

        .pipe($.if(!ISPRODUCTION, $.sourcemaps.write()))
        .pipe(gulp.dest(DISTPATH + '/css/'));
});

gulp.task('js-app', function () {
    var uglify = $.if(ISPRODUCTION, $.uglify()
        .on('error', function (e) {
            console.log(e);
        }));
    return gulp.src(['src/js/app/*.js'])
        .pipe(uglify)
        .pipe(gulp.dest(DISTPATH + '/js/'));
});

gulp.task('js-pages', function () {
    var uglify = $.if(ISPRODUCTION, $.uglify()
        .on('error', function (e) {
            console.log(e);
        }));
    return gulp.src(['src/js/pages/*.js'])
        .pipe(uglify)
        .pipe(gulp.dest(DISTPATH + '/js/pages'));
});

gulp.task('js-core', function () {
    var uglify = $.if(ISPRODUCTION, $.uglify()
        .on('error', function (e) {
            console.log(e);
        }));
    return gulp.src(PATHS.jsCore)
        .pipe($.sourcemaps.init())
        .pipe($.concat('core.js'))
        .pipe(uglify)
        .pipe($.if(!ISPRODUCTION, $.sourcemaps.write()))
        .pipe(gulp.dest(DISTPATH + '/js'));
});

gulp.task('images', function () {
    var imagemin = $.if(ISPRODUCTION, $.imagemin({
        progressive: true
    }));

    return gulp.src('src/img/**/*')
        .pipe(imagemin)
        .pipe(gulp.dest(DISTPATH + '/img'));
});

gulp.task('build', function (done) {
    sequence('clean', ['sass', 'js-core', 'js-pages', 'js-app', 'images', 'copy'], done);
});

gulp.task('watch', ['build'], function () {
    gulp.watch([PATHS.sass], ['sass']);
    gulp.watch([PATHS.js], ['js-core', 'js-pages', 'js-app']);
    gulp.watch([PATHS.img], ['images']);
});

gulp.task('archive', function () {
    return gulp.src(PATHS.archive)
        .pipe(zip(config.name + '.' + config.version + '.zip', false))
        .pipe(gulp.dest('archives'))
});
//	HYPE.documents["Тара"]

(function () {
    (function k() {
        function l(a, b, d) {
            var c = !1;
            null == window[a] && (null == window[b] ? (window[b] = [], window[b].push(k), a = document.getElementsByTagName("head")[0], b = document.createElement("script"), c = h, false == !0 && (c = ""), b.type = "text/javascript", b.src = c + "/" + d, a.appendChild(b)) : window[b].push(k), c = !0);
            return c
        }

        var h = "/dist/home/container/", c = "Тара", e = "тара_hype_container";
        if (false == !1)try {
            for (var f = document.getElementsByTagName("script"),
                     a = 0; a < f.length; a++) {
                var b = f[a].src;
                if (null != b && -1 != b.indexOf("container_hype_generated_script.js")) {
                    h = b.substr(0, b.lastIndexOf("/"));
                    break
                }
            }
        } catch (n) {
        }
        if (false == !1 && (a = navigator.userAgent.match(/MSIE (\d+\.\d+)/), a = parseFloat(a && a[1]) || null, a = l("HYPE_526", "HYPE_dtl_526", !0 == (null != a && 10 > a || false == !0) ? "HYPE-526.full.min.js" : "HYPE-526.thin.min.js"), false == !0 && (a = a || l("HYPE_w_526", "HYPE_wdtl_526", "HYPE-526.waypoints.min.js")), a))return;
        f = window.HYPE.documents;
        if (null != f[c]) {
            b = 1;
            a = c;
            do c = "" + a + "-" + b++; while (null != f[c]);
            for (var d = document.getElementsByTagName("div"), b = !1, a = 0; a < d.length; a++)if (d[a].id == e && null == d[a].getAttribute("HYP_dn")) {
                var b = 1, g = e;
                do e = "" + g + "-" + b++; while (null != document.getElementById(e));
                d[a].id = e;
                b = !0;
                break
            }
            if (!1 == b)return
        }
        b = [];
        b = [];
        d = {};
        g = {};
        for (a = 0; a < b.length; a++)try {
            g[b[a].identifier] = b[a].name, d[b[a].name] = eval("(function(){return " + b[a].source + "})();")
        } catch (m) {
            window.console && window.console.log(m),
                d[b[a].name] = function () {
                }
        }
        a = new HYPE_526(c, e, {
            "7": {p: 1, n: "corob.svg", g: "892", t: "image/svg+xml"},
            "3": {p: 1, n: "sklyan3.svg", g: "884", t: "image/svg+xml"},
            "4": {p: 1, n: "sklyan2.svg", g: "886", t: "image/svg+xml"},
            "0": {p: 1, n: "Shape%202.svg", g: "299", t: "image/svg+xml"},
            "5": {p: 1, n: "sklyan1.svg", g: "888", t: "image/svg+xml"},
            "1": {p: 1, n: "Shape%201.svg", g: "301", t: "image/svg+xml"},
            "6": {p: 1, n: "shar1.svg", g: "890", t: "image/svg+xml"},
            "2": {p: 1, n: "Shape%203.svg", g: "297", t: "image/svg+xml"}
        }, h, [], d, [{n: "\u0422\u0430\u0440\u0430", o: "863", X: [0]}], [{
            A: {
                a: [{
                    p: 7,
                    b: "kTimelineDefaultIdentifier",
                    symbolOid: "864"
                }]
            },
            o: "877",
            p: "600px",
            x: 0,
            B: {a: [{p: 7, b: "kTimelineDefaultIdentifier", symbolOid: "864"}]},
            Z: 200,
            cA: false,
            Y: 270,
            c: "#FFFFFF",
            L: [],
            bY: 1,
            d: 270,
            U: {},
            T: {
                kTimelineDefaultIdentifier: {
                    i: "kTimelineDefaultIdentifier",
                    n: "Main Timeline",
                    z: 1.22,
                    b: [],
                    a: [{f: "c", y: 0, z: 0.09, i: "a", e: 118, s: 115, o: "1102"}, {
                        f: "c",
                        y: 0,
                        z: 0.14,
                        i: "f",
                        e: 16,
                        s: 0,
                        o: "1092"
                    }, {f: "c", y: 0, z: 0.18, i: "f", e: -108, s: -146, o: "1090"}, {
                        f: "c",
                        y: 0,
                        z: 0.25,
                        i: "f",
                        e: -253,
                        s: -152,
                        o: "1095"
                    }, {f: "c", y: 0, z: 0.2, i: "f", e: -173, s: -146, o: "1106"}, {
                        f: "c",
                        y: 0,
                        z: 0.14,
                        i: "b",
                        e: 117,
                        s: 138,
                        o: "1100"
                    }, {f: "c", y: 0, z: 0.14, i: "c", e: 2, s: 2, o: "1100"}, {
                        f: "c",
                        y: 0,
                        z: 0.14,
                        i: "d",
                        e: 23,
                        s: 2,
                        o: "1100"
                    }, {f: "c", y: 0, z: 0.22, i: "a", e: 199, s: 199, o: "1100"}, {
                        f: "c",
                        y: 0.09,
                        z: 0.14,
                        i: "d",
                        e: 23,
                        s: 2,
                        o: "1096"
                    }, {f: "c", y: 0.09, z: 0.14, i: "b", e: 117, s: 138, o: "1096"}, {
                        f: "c",
                        y: 0.09,
                        z: 0.14,
                        i: "c",
                        e: 2,
                        s: 2,
                        o: "1096"
                    }, {f: "c", y: 0.09, z: 0.1, i: "a", e: 112.666, s: 118, o: "1102"}, {
                        f: "c",
                        y: 0.14,
                        z: 0.12,
                        i: "f",
                        e: -23,
                        s: 16,
                        o: "1092"
                    }, {f: "c", y: 0.14, z: 0.08, i: "b", e: 114, s: 117, o: "1100"}, {
                        f: "c",
                        y: 0.14,
                        z: 0.08,
                        i: "c",
                        e: 2,
                        s: 2,
                        o: "1100"
                    }, {f: "c", y: 0.14, z: 0.08, i: "d", e: 17, s: 23, o: "1100"}, {
                        f: "c",
                        y: 0.17,
                        z: 0.14,
                        i: "b",
                        e: 117,
                        s: 138,
                        o: "1091"
                    }, {f: "c", y: 0.17, z: 0.14, i: "d", e: 23, s: 2, o: "1091"}, {
                        f: "c",
                        y: 0.17,
                        z: 0.14,
                        i: "c",
                        e: 2,
                        s: 2,
                        o: "1091"
                    }, {f: "c", y: 0.18, z: 0.14, i: "f", e: -172, s: -108, o: "1090"}, {
                        f: "c",
                        y: 0.19,
                        z: 0.1,
                        i: "a",
                        e: 118,
                        s: 112.666,
                        o: "1102"
                    }, {f: "c", y: 0.2, z: 0.14, i: "f", e: -134, s: -173, o: "1106"}, {
                        y: 0.22,
                        i: "a",
                        s: 199,
                        z: 0,
                        o: "1100",
                        f: "c"
                    }, {f: "c", y: 0.22, z: 0.13, i: "c", e: 3, s: 2, o: "1100"}, {
                        f: "c",
                        y: 0.22,
                        z: 0.13,
                        i: "d",
                        e: 1,
                        s: 17,
                        o: "1100"
                    }, {f: "c", y: 0.22, z: 0.13, i: "b", e: 105, s: 114, o: "1100"}, {
                        f: "c",
                        y: 0.23,
                        z: 0.08,
                        i: "d",
                        e: 17,
                        s: 23,
                        o: "1096"
                    }, {f: "c", y: 0.23, z: 0.08, i: "b", e: 114, s: 117, o: "1096"}, {
                        f: "c",
                        y: 0.23,
                        z: 0.08,
                        i: "c",
                        e: 2,
                        s: 2,
                        o: "1096"
                    }, {f: "c", y: 0.25, z: 0.14, i: "f", e: -127, s: -253, o: "1095"}, {
                        f: "c",
                        y: 0.26,
                        z: 0.11,
                        i: "f",
                        e: 12,
                        s: -23,
                        o: "1092"
                    }, {f: "c", y: 0.29, z: 0.1, i: "a", e: 112, s: 118, o: "1102"}, {
                        f: "c",
                        y: 1.01,
                        z: 0.08,
                        i: "c",
                        e: 2,
                        s: 2,
                        o: "1091"
                    }, {f: "c", y: 1.01, z: 0.08, i: "d", e: 17, s: 23, o: "1091"}, {
                        f: "c",
                        y: 1.01,
                        z: 0.08,
                        i: "b",
                        e: 114,
                        s: 117,
                        o: "1091"
                    }, {f: "c", y: 1.01, z: 0.13, i: "d", e: 1, s: 17, o: "1096"}, {
                        f: "c",
                        y: 1.01,
                        z: 0.13,
                        i: "b",
                        e: 105,
                        s: 114,
                        o: "1096"
                    }, {f: "c", y: 1.01, z: 0.13, i: "c", e: 3, s: 2, o: "1096"}, {
                        f: "c",
                        y: 1.02,
                        z: 0.1,
                        i: "f",
                        e: -122,
                        s: -172,
                        o: "1090"
                    }, {f: "c", y: 1.04, z: 0.08, i: "f", e: -162, s: -134, o: "1106"}, {
                        y: 1.05,
                        i: "c",
                        s: 3,
                        z: 0,
                        o: "1100",
                        f: "c"
                    }, {y: 1.05, i: "b", s: 105, z: 0, o: "1100", f: "c"}, {
                        y: 1.05,
                        i: "d",
                        s: 1,
                        z: 0,
                        o: "1100",
                        f: "c"
                    }, {f: "c", y: 1.07, z: 0.07, i: "f", e: -6, s: 12, o: "1092"}, {
                        f: "c",
                        y: 1.09,
                        z: 0.05,
                        i: "d",
                        e: 23,
                        s: 2,
                        o: "1104"
                    }, {f: "c", y: 1.09, z: 0.05, i: "b", e: 117, s: 138, o: "1104"}, {
                        f: "c",
                        y: 1.09,
                        z: 0.05,
                        i: "c",
                        e: 2,
                        s: 2,
                        o: "1104"
                    }, {f: "c", y: 1.09, z: 0.13, i: "b", e: 105, s: 114, o: "1091"}, {
                        f: "c",
                        y: 1.09,
                        z: 0.13,
                        i: "c",
                        e: 3,
                        s: 2,
                        o: "1091"
                    }, {f: "c", y: 1.09, z: 0.07, i: "f", e: -169, s: -127, o: "1095"}, {
                        f: "c",
                        y: 1.09,
                        z: 0.13,
                        i: "d",
                        e: 1,
                        s: 17,
                        o: "1091"
                    }, {f: "c", y: 1.09, z: 0.07, i: "a", e: 116, s: 112, o: "1102"}, {
                        f: "c",
                        y: 1.12,
                        z: 0.08,
                        i: "f",
                        e: -155,
                        s: -122,
                        o: "1090"
                    }, {f: "c", y: 1.12, z: 0.05, i: "f", e: -139, s: -162, o: "1106"}, {
                        f: "c",
                        y: 1.14,
                        z: 0.03,
                        i: "d",
                        e: 17,
                        s: 23,
                        o: "1104"
                    }, {f: "c", y: 1.14, z: 0.03, i: "b", e: 114, s: 117, o: "1104"}, {
                        f: "c",
                        y: 1.14,
                        z: 0.03,
                        i: "c",
                        e: 2,
                        s: 2,
                        o: "1104"
                    }, {y: 1.14, i: "d", s: 1, z: 0, o: "1096", f: "c"}, {
                        y: 1.14,
                        i: "b",
                        s: 105,
                        z: 0,
                        o: "1096",
                        f: "c"
                    }, {y: 1.14, i: "c", s: 3, z: 0, o: "1096", f: "c"}, {
                        f: "c",
                        y: 1.14,
                        z: 0.05,
                        i: "f",
                        e: 3,
                        s: -6,
                        o: "1092"
                    }, {f: "c", y: 1.16, z: 0.04, i: "f", e: -144, s: -169, o: "1095"}, {
                        f: "c",
                        y: 1.16,
                        z: 0.06,
                        i: "a",
                        e: 115,
                        s: 116,
                        o: "1102"
                    }, {f: "c", y: 1.17, z: 0.05, i: "d", e: 1, s: 17, o: "1104"}, {
                        f: "c",
                        y: 1.17,
                        z: 0.05,
                        i: "b",
                        e: 108,
                        s: 114,
                        o: "1104"
                    }, {f: "c", y: 1.17, z: 0.05, i: "c", e: 3, s: 2, o: "1104"}, {
                        f: "c",
                        y: 1.17,
                        z: 0.05,
                        i: "f",
                        e: -146,
                        s: -139,
                        o: "1106"
                    }, {f: "c", y: 1.19, z: 0.03, i: "f", e: 0, s: 3, o: "1092"}, {
                        f: "c",
                        y: 1.2,
                        z: 0.02,
                        i: "f",
                        e: -146,
                        s: -155,
                        o: "1090"
                    }, {f: "c", y: 1.2, z: 0.02, i: "f", e: -152, s: -144, o: "1095"}, {
                        y: 1.22,
                        i: "d",
                        s: 1,
                        z: 0,
                        o: "1091",
                        f: "c"
                    }, {y: 1.22, i: "c", s: 3, z: 0, o: "1091", f: "c"}, {
                        y: 1.22,
                        i: "b",
                        s: 105,
                        z: 0,
                        o: "1091",
                        f: "c"
                    }, {y: 1.22, i: "d", s: 1, z: 0, o: "1104", f: "c"}, {
                        y: 1.22,
                        i: "b",
                        s: 108,
                        z: 0,
                        o: "1104",
                        f: "c"
                    }, {y: 1.22, i: "c", s: 3, z: 0, o: "1104", f: "c"}, {
                        y: 1.22,
                        i: "f",
                        s: -146,
                        z: 0,
                        o: "1090",
                        f: "c"
                    }, {y: 1.22, i: "f", s: -152, z: 0, o: "1095", f: "c"}, {
                        y: 1.22,
                        i: "f",
                        s: -146,
                        z: 0,
                        o: "1106",
                        f: "c"
                    }, {y: 1.22, i: "a", s: 115, z: 0, o: "1102", f: "c"}, {
                        y: 1.22,
                        i: "f",
                        s: 0,
                        z: 0,
                        o: "1092",
                        f: "c"
                    }],
                    f: 30
                }
            },
            bZ: 180,
            O: ["1107", "1104", "1100", "1096", "1091", "1105", "1088", "1097", "1094", "1103", "1089", "1098", "1092", "1095", "1090", "1106", "1101", "1093", "1099", "1102"],
            v: {
                "1094": {
                    c: 6,
                    d: 2,
                    I: "None",
                    J: "None",
                    f: 0,
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    O: 0,
                    j: "absolute",
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 44,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 128,
                    aL: 10,
                    b: 119
                },
                "1099": {
                    h: "888",
                    p: "no-repeat",
                    x: "visible",
                    a: 180,
                    q: "100% 100%",
                    b: 53,
                    j: "absolute",
                    r: "inline",
                    c: 52,
                    k: "div",
                    z: 34,
                    d: 88
                },
                "1088": {
                    c: 6,
                    d: 2,
                    I: "None",
                    J: "None",
                    f: 0,
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    O: 0,
                    j: "absolute",
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 46,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 86,
                    aL: 10,
                    b: 145
                },
                "1104": {
                    c: 2,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#252525",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#252525",
                    z: 51,
                    B: "#252525",
                    D: "#252525",
                    aK: 10,
                    P: 0,
                    a: 193,
                    aL: 10,
                    b: 138
                },
                "1092": {
                    w: "",
                    h: "886",
                    p: "no-repeat",
                    x: "visible",
                    tY: 0.70999999999999996,
                    q: "100% 100%",
                    a: 138,
                    b: 64,
                    j: "absolute",
                    z: 40,
                    k: "div",
                    c: 56,
                    d: 98,
                    r: "inline",
                    F: "right",
                    f: 0,
                    tX: 0.5
                },
                "1097": {
                    c: 6,
                    d: 2,
                    I: "None",
                    J: "None",
                    f: 0,
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    O: 0,
                    j: "absolute",
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 45,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 138,
                    aL: 10,
                    b: 119
                },
                "1102": {
                    h: "884",
                    p: "no-repeat",
                    x: "visible",
                    a: 115,
                    q: "100% 100%",
                    b: 28,
                    j: "absolute",
                    r: "inline",
                    c: 24,
                    k: "div",
                    z: 33,
                    d: 34
                },
                "1090": {
                    h: "299",
                    p: "no-repeat",
                    x: "visible",
                    tY: 0,
                    q: "100% 100%",
                    a: 85,
                    j: "absolute",
                    b: 115,
                    z: 38,
                    k: "div",
                    c: 19,
                    d: 10,
                    r: "inline",
                    f: -146,
                    tX: -0.63
                },
                "1107": {
                    c: 268,
                    d: 198,
                    I: "Solid",
                    e: 0,
                    J: "Solid",
                    K: "Solid",
                    g: "#E8EBED",
                    L: "Solid",
                    M: 1,
                    N: 1,
                    A: "#D8DDE4",
                    x: "visible",
                    j: "absolute",
                    B: "#D8DDE4",
                    k: "div",
                    O: 1,
                    C: "#D8DDE4",
                    z: 52,
                    P: 1,
                    D: "#D8DDE4",
                    a: 0,
                    aD: {a: [{b: "kTimelineDefaultIdentifier", p: 3, z: false, symbolOid: "187"}]},
                    b: 0
                },
                "1095": {
                    h: "301",
                    p: "no-repeat",
                    aI: 4,
                    tY: 1.76,
                    a: 75,
                    b: 85,
                    x: "visible",
                    aJ: 4,
                    z: 39,
                    q: "100% 100%",
                    j: "absolute",
                    d: 17,
                    aK: 4,
                    k: "div",
                    c: 8,
                    r: "inline",
                    aL: 4,
                    f: -152,
                    tX: -0.12
                },
                "1100": {
                    c: 2,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#252525",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#252525",
                    z: 50,
                    B: "#252525",
                    D: "#252525",
                    aK: 10,
                    P: 0,
                    a: 199,
                    aL: 10,
                    b: 138
                },
                "1089": {
                    c: 16,
                    d: 2,
                    I: "None",
                    J: "None",
                    f: 0,
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    O: 0,
                    j: "absolute",
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 42,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 108,
                    aL: 10,
                    b: 119
                },
                "1105": {
                    c: 6,
                    d: 2,
                    I: "None",
                    J: "None",
                    f: 0,
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    O: 0,
                    j: "absolute",
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 47,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 75,
                    aL: 10,
                    b: 145
                },
                "1093": {
                    h: "890",
                    p: "no-repeat",
                    x: "visible",
                    a: 66,
                    q: "100% 100%",
                    b: 108,
                    j: "absolute",
                    r: "inline",
                    c: 13,
                    k: "div",
                    z: 35,
                    d: 14,
                    f: 0
                },
                "1098": {
                    c: 32,
                    d: 2,
                    I: "None",
                    J: "None",
                    f: 0,
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    O: 0,
                    j: "absolute",
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 41,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 112,
                    aL: 10,
                    b: 145
                },
                "1103": {
                    c: 10,
                    d: 2,
                    I: "None",
                    J: "None",
                    f: 0,
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    O: 0,
                    j: "absolute",
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 43,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 97,
                    aL: 10,
                    b: 145
                },
                "1091": {
                    c: 2,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#252525",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#252525",
                    z: 48,
                    B: "#252525",
                    D: "#252525",
                    aK: 10,
                    P: 0,
                    a: 213,
                    aL: 10,
                    b: 138
                },
                "1096": {
                    c: 2,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#252525",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#252525",
                    z: 49,
                    B: "#252525",
                    D: "#252525",
                    aK: 10,
                    P: 0,
                    a: 207,
                    aL: 10,
                    b: 138
                },
                "1101": {
                    w: "",
                    h: "892",
                    p: "no-repeat",
                    x: "visible",
                    a: 78,
                    q: "100% 100%",
                    b: 59,
                    j: "absolute",
                    r: "inline",
                    c: 64,
                    k: "div",
                    z: 36,
                    d: 34
                },
                "1106": {
                    h: "297",
                    p: "no-repeat",
                    x: "visible",
                    tY: 1.5,
                    q: "100% 100%",
                    a: 84,
                    j: "absolute",
                    b: 95,
                    z: 37,
                    k: "div",
                    c: 19,
                    d: 14,
                    r: "inline",
                    f: -146,
                    tX: -0.53000000000000003
                }
            }
        }], {}, g, {}, null, false, true, -1, true, true, false, true);
        f[c] = a.API;
        document.getElementById(e).setAttribute("HYP_dn",
            c);
        a.z_o(this.body)
    })();
})();

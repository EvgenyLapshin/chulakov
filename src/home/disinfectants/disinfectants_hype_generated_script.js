//	HYPE.documents["Дизинфекция"]

(function () {
    (function k() {
        function l(a, b, d) {
            var c = !1;
            null == window[a] && (null == window[b] ? (window[b] = [], window[b].push(k), a = document.getElementsByTagName("head")[0], b = document.createElement("script"), c = h, false == !0 && (c = ""), b.type = "text/javascript", b.src = c + "/" + d, a.appendChild(b)) : window[b].push(k), c = !0);
            return c
        }

        var h = "/dist/home/disinfectants/", c = "Дизинфекция", e = "дизинфекция_hype_container";
        if (false == !1)try {
            for (var f = document.getElementsByTagName("script"),
                     a = 0; a < f.length; a++) {
                var b = f[a].src;
                if (null != b && -1 != b.indexOf("disinfectants_hype_generated_script.js")) {
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
            "7": {p: 1, n: "g1.svg", g: "857", t: "image/svg+xml"},
            "3": {p: 1, n: "m2.svg", g: "849", t: "image/svg+xml"},
            "8": {p: 1, n: "c2.svg", g: "859", t: "image/svg+xml"},
            "4": {p: 1, n: "m1.svg", g: "851", t: "image/svg+xml"},
            "0": {p: 1, n: "s3.svg", g: "843", t: "image/svg+xml"},
            "9": {p: 1, n: "c1.svg", g: "861", t: "image/svg+xml"},
            "5": {p: 1, n: "g3.svg", g: "853", t: "image/svg+xml"},
            "1": {p: 1, n: "s2.svg", g: "845", t: "image/svg+xml"},
            "6": {p: 1, n: "g2.svg", g: "855", t: "image/svg+xml"},
            "2": {p: 1, n: "s1.svg", g: "847", t: "image/svg+xml"}
        }, h, [], d, [{
            n: "\u0414\u0438\u0437\u0438\u043d\u0444\u0435\u043a\u0446\u0438\u044f",
            o: "817",
            X: [0]
        }], [{
            A: {a: [{p: 7, b: "kTimelineDefaultIdentifier", symbolOid: "818"}]},
            o: "840",
            p: "600px",
            x: 0,
            cA: false,
            Z: 200,
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
                    a: [{f: "c", y: 0, z: 1.22, i: "f", e: 360, s: 0, o: "1090"}, {
                        f: "c",
                        y: 0,
                        z: 1.22,
                        i: "f",
                        e: 360,
                        s: 0,
                        o: "1098"
                    }, {f: "c", y: 0, z: 1.22, i: "f", e: 360, s: 0, o: "1092"}, {
                        f: "c",
                        y: 0,
                        z: 0.15,
                        i: "f",
                        e: 25,
                        s: 0,
                        o: "1094"
                    }, {f: "c", y: 0, z: 0.17, i: "f", e: 96, s: 0, o: "1096"}, {
                        f: "c",
                        y: 0,
                        z: 0.17,
                        i: "f",
                        e: -96,
                        s: 0,
                        o: "1097"
                    }, {f: "c", y: 0, z: 0.16, i: "f", e: -91, s: 0, o: "1089"}, {
                        f: "c",
                        y: 0,
                        z: 0.24,
                        i: "a",
                        e: 224,
                        s: 190,
                        o: "1091"
                    }, {f: "c", y: 0, z: 0.24, i: "b", e: 149, s: 133, o: "1091"}, {
                        f: "c",
                        y: 0,
                        z: 0.24,
                        i: "a",
                        e: 27,
                        s: 64,
                        o: "1095"
                    }, {f: "c", y: 0, z: 0.24, i: "b", e: 171, s: 143, o: "1095"}, {
                        f: "c",
                        y: 0,
                        z: 0.29,
                        i: "a",
                        e: 5,
                        s: 54,
                        o: "1088"
                    }, {f: "c", y: 0, z: 0.29, i: "b", e: 33, s: 69, o: "1088"}, {
                        f: "c",
                        y: 0,
                        z: 0.21,
                        i: "e",
                        e: 1,
                        s: 1,
                        o: "1088"
                    }, {f: "c", y: 0.15, z: 0.16, i: "f", e: -17, s: 25, o: "1094"}, {
                        f: "c",
                        y: 0.16,
                        z: 0.16,
                        i: "f",
                        e: 6,
                        s: -91,
                        o: "1089"
                    }, {f: "c", y: 0.17, z: 0.07, i: "e", e: 0, s: 1, o: "1091"}, {
                        f: "c",
                        y: 0.17,
                        z: 0.19,
                        i: "f",
                        e: -43,
                        s: 96,
                        o: "1096"
                    }, {f: "c", y: 0.17, z: 0.17, i: "f", e: 27, s: -96, o: "1097"}, {
                        f: "c",
                        y: 0.18,
                        z: 0.06,
                        i: "e",
                        e: 0,
                        s: 1,
                        o: "1095"
                    }, {f: "c", y: 0.21, z: 0.08, i: "e", e: 0, s: 1, o: "1088"}, {
                        f: "c",
                        y: 0.24,
                        z: 0.1,
                        i: "a",
                        e: 190,
                        s: 224,
                        o: "1091"
                    }, {f: "c", y: 0.24, z: 0.1, i: "b", e: 133, s: 149, o: "1091"}, {
                        f: "c",
                        y: 0.24,
                        z: 0.16,
                        i: "e",
                        e: 0,
                        s: 0,
                        o: "1091"
                    }, {f: "c", y: 0.24, z: 0.06, i: "a", e: 64, s: 27, o: "1095"}, {
                        f: "c",
                        y: 0.24,
                        z: 0.06,
                        i: "b",
                        e: 143,
                        s: 171,
                        o: "1095"
                    }, {f: "c", y: 0.24, z: 0.13, i: "e", e: 0, s: 0, o: "1095"}, {
                        f: "c",
                        y: 0.29,
                        z: 0.07,
                        i: "a",
                        e: 54,
                        s: 5,
                        o: "1088"
                    }, {f: "c", y: 0.29, z: 0.07, i: "b", e: 69, s: 33, o: "1088"}, {
                        f: "c",
                        y: 0.29,
                        z: 0.1,
                        i: "e",
                        e: 0,
                        s: 0,
                        o: "1088"
                    }, {y: 1, i: "a", s: 64, z: 0, o: "1095", f: "c"}, {
                        y: 1,
                        i: "b",
                        s: 143,
                        z: 0,
                        o: "1095",
                        f: "c"
                    }, {f: "c", y: 1.01, z: 0.12, i: "f", e: 30, s: -17, o: "1094"}, {
                        f: "c",
                        y: 1.02,
                        z: 0.12,
                        i: "f",
                        e: -30,
                        s: 6,
                        o: "1089"
                    }, {f: "c", y: 1.04, z: 0.09, i: "f", e: -31, s: 27, o: "1097"}, {
                        y: 1.04,
                        i: "a",
                        s: 190,
                        z: 0,
                        o: "1091",
                        f: "c"
                    }, {y: 1.04, i: "b", s: 133, z: 0, o: "1091", f: "c"}, {
                        f: "c",
                        y: 1.06,
                        z: 0.09,
                        i: "f",
                        e: 30,
                        s: -43,
                        o: "1096"
                    }, {y: 1.06, i: "a", s: 54, z: 0, o: "1088", f: "c"}, {
                        y: 1.06,
                        i: "b",
                        s: 69,
                        z: 0,
                        o: "1088",
                        f: "c"
                    }, {f: "c", y: 1.07, z: 0.15, i: "e", e: 1, s: 0, o: "1095"}, {
                        f: "c",
                        y: 1.09,
                        z: 0.13,
                        i: "e",
                        e: 1,
                        s: 0,
                        o: "1088"
                    }, {f: "c", y: 1.1, z: 0.12, i: "e", e: 1, s: 0, o: "1091"}, {
                        f: "c",
                        y: 1.13,
                        z: 0.09,
                        i: "f",
                        e: 0,
                        s: 30,
                        o: "1094"
                    }, {f: "c", y: 1.13, z: 0.09, i: "f", e: 0, s: -31, o: "1097"}, {
                        f: "c",
                        y: 1.14,
                        z: 0.08,
                        i: "f",
                        e: 0,
                        s: -30,
                        o: "1089"
                    }, {f: "c", y: 1.15, z: 0.07, i: "f", e: 0, s: 30, o: "1096"}, {
                        y: 1.22,
                        i: "f",
                        s: 360,
                        z: 0,
                        o: "1090",
                        f: "c"
                    }, {y: 1.22, i: "f", s: 360, z: 0, o: "1098", f: "c"}, {
                        y: 1.22,
                        i: "f",
                        s: 360,
                        z: 0,
                        o: "1092",
                        f: "c"
                    }, {y: 1.22, i: "e", s: 1, z: 0, o: "1091", f: "c"}, {
                        y: 1.22,
                        i: "e",
                        s: 1,
                        z: 0,
                        o: "1095",
                        f: "c"
                    }, {y: 1.22, i: "f", s: 0, z: 0, o: "1094", f: "c"}, {
                        y: 1.22,
                        i: "f",
                        s: 0,
                        z: 0,
                        o: "1096",
                        f: "c"
                    }, {y: 1.22, i: "f", s: 0, z: 0, o: "1097", f: "c"}, {
                        y: 1.22,
                        i: "f",
                        s: 0,
                        z: 0,
                        o: "1089",
                        f: "c"
                    }, {y: 1.22, i: "e", s: 1, z: 0, o: "1088", f: "c"}],
                    f: 30
                }
            },
            bZ: 180,
            O: ["1093", "1098", "1090", "1096", "1097", "1089", "1092", "1094", "1088", "1091", "1095"],
            v: {
                "1088": {
                    h: "847",
                    p: "no-repeat",
                    x: "visible",
                    a: 54,
                    q: "100% 100%",
                    b: 69,
                    j: "absolute",
                    r: "inline",
                    c: 19,
                    k: "div",
                    z: 23,
                    d: 15,
                    e: 1
                },
                "1098": {
                    h: "861",
                    p: "no-repeat",
                    x: "visible",
                    a: 200,
                    q: "100% 100%",
                    b: 62,
                    j: "absolute",
                    r: "inline",
                    c: 16,
                    k: "div",
                    z: 30,
                    d: 15,
                    f: 0
                },
                "1095": {
                    h: "843",
                    p: "no-repeat",
                    x: "visible",
                    a: 64,
                    q: "100% 100%",
                    b: 143,
                    j: "absolute",
                    r: "inline",
                    c: 25,
                    k: "div",
                    z: 21,
                    d: 15,
                    e: 1
                },
                "1092": {
                    h: "851",
                    p: "no-repeat",
                    x: "visible",
                    a: 84,
                    q: "100% 100%",
                    b: 24,
                    j: "absolute",
                    r: "inline",
                    c: 67,
                    k: "div",
                    z: 25,
                    d: 66,
                    f: 0
                },
                "1089": {
                    h: "853",
                    p: "no-repeat",
                    x: "visible",
                    a: 168,
                    q: "100% 100%",
                    b: 38,
                    j: "absolute",
                    r: "inline",
                    c: 23,
                    k: "div",
                    z: 26,
                    d: 20,
                    f: 0
                },
                "1096": {
                    h: "857",
                    p: "no-repeat",
                    x: "visible",
                    a: 55,
                    q: "100% 100%",
                    b: 97,
                    j: "absolute",
                    r: "inline",
                    c: 18,
                    k: "div",
                    z: 28,
                    d: 25,
                    f: 0
                },
                "1093": {
                    c: 268,
                    d: 198,
                    I: "Solid",
                    r: "inline",
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
                    z: 31,
                    P: 1,
                    D: "#D8DDE4",
                    a: 0,
                    aD: {a: [{b: "kTimelineDefaultIdentifier", p: 3, z: false, symbolOid: "187"}]},
                    b: 0
                },
                "1090": {
                    h: "859",
                    p: "no-repeat",
                    x: "visible",
                    a: 191,
                    q: "100% 100%",
                    b: 86,
                    j: "absolute",
                    r: "inline",
                    c: 16,
                    k: "div",
                    z: 29,
                    d: 15,
                    f: 0
                },
                "1097": {
                    h: "855",
                    p: "no-repeat",
                    x: "visible",
                    a: 176,
                    q: "100% 100%",
                    b: 138,
                    j: "absolute",
                    r: "inline",
                    c: 18,
                    k: "div",
                    z: 27,
                    d: 25,
                    f: 0
                },
                "1094": {
                    h: "849",
                    p: "no-repeat",
                    x: "visible",
                    a: 100,
                    q: "100% 100%",
                    b: 84,
                    j: "absolute",
                    r: "inline",
                    c: 83,
                    k: "div",
                    z: 24,
                    d: 68,
                    f: 0
                },
                "1091": {
                    h: "845",
                    p: "no-repeat",
                    x: "visible",
                    a: 190,
                    q: "100% 100%",
                    b: 133,
                    j: "absolute",
                    r: "inline",
                    c: 25,
                    k: "div",
                    z: 22,
                    d: 13,
                    e: 1
                }
            }
        }], {}, g, {}, null, false, true, -1, true, true, false, true);
        f[c] = a.API;
        document.getElementById(e).setAttribute("HYP_dn",
            c);
        a.z_o(this.body)
    })();
})();

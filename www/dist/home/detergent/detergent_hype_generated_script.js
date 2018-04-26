//	HYPE.documents["Моющие"]

(function () {
    (function k() {
        function l(a, b, d) {
            var c = !1;
            null == window[a] && (null == window[b] ? (window[b] = [], window[b].push(k), a = document.getElementsByTagName("head")[0], b = document.createElement("script"), c = h, false == !0 && (c = ""), b.type = "text/javascript", b.src = c + "/" + d, a.appendChild(b)) : window[b].push(k), c = !0);
            return c
        }

        var h = "/dist/home/detergent", c = "Моющие", e = "моющие_hype_container";
        if (false == !1)try {
            for (var f = document.getElementsByTagName("script"),
                     a = 0; a < f.length; a++) {
                var b = f[a].src;
                if (null != b && -1 != b.indexOf("detergent_hype_generated_script.js")) {
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
            "3": {p: 1, n: "salfet.svg", g: "444", t: "image/svg+xml"},
            "1": {p: 1, n: "water.svg", g: "453", t: "image/svg+xml"},
            "2": {p: 1, n: "puf.svg", g: "446", t: "image/svg+xml"},
            "0": {p: 1, n: "Group%202.svg", g: "164", t: "image/svg+xml"}
        }, h, [], d, [{n: "\u041c\u043e\u044e\u0449\u0438\u0435", o: "413", X: [0]}], [{
            A: {
                a: [{
                    p: 7,
                    b: "kTimelineDefaultIdentifier",
                    symbolOid: "414"
                }]
            },
            o: "424",
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
                    a: [{f: "c", y: 0, z: 0.19, i: "a", e: 33, s: 48, o: "1095"}, {
                        f: "c",
                        y: 0,
                        z: 0.17,
                        i: "b",
                        e: 62,
                        s: 61,
                        o: "1090"
                    }, {f: "c", y: 0, z: 0.17, i: "d", e: 65, s: 1, o: "1090"}, {
                        f: "c",
                        y: 0,
                        z: 0.12,
                        i: "f",
                        e: -3,
                        s: 0,
                        o: "1090"
                    }, {f: "c", y: 0, z: 0.14, i: "a", e: 45, s: 58, o: "1091"}, {
                        f: "c",
                        y: 0,
                        z: 0.2,
                        i: "f",
                        e: 103,
                        s: 0,
                        o: "1094"
                    }, {f: "c", y: 0, z: 0.14, i: "a", e: 155, s: 167, o: "1089"}, {
                        f: "c",
                        y: 0,
                        z: 0.22,
                        i: "a",
                        e: 157,
                        s: 174,
                        o: "1096"
                    }, {f: "c", y: 0, z: 0.14, i: "a", e: 245, s: 218, o: "1092"}, {
                        f: "c",
                        y: 0.12,
                        z: 0.15,
                        i: "f",
                        e: 9,
                        s: -3,
                        o: "1090"
                    }, {f: "c", y: 0.14, z: 0.21, i: "a", e: 79, s: 45, o: "1091"}, {
                        f: "c",
                        y: 0.14,
                        z: 0.18,
                        i: "a",
                        e: 180,
                        s: 155,
                        o: "1089"
                    }, {f: "c", y: 0.14, z: 0.17, i: "a", e: 208, s: 245, o: "1092"}, {
                        y: 0.17,
                        i: "b",
                        s: 62,
                        z: 0,
                        o: "1090",
                        f: "c"
                    }, {f: "c", y: 0.17, z: 0.16, i: "d", e: 19, s: 65, o: "1090"}, {
                        f: "c",
                        y: 0.19,
                        z: 0.17,
                        i: "a",
                        e: 69,
                        s: 33,
                        o: "1095"
                    }, {f: "c", y: 0.2, z: 0.18, i: "f", e: -89, s: 103, o: "1094"}, {
                        f: "c",
                        y: 0.22,
                        z: 0.13,
                        i: "a",
                        e: 182,
                        s: 157,
                        o: "1096"
                    }, {f: "c", y: 0.27, z: 0.07, i: "f", e: -1, s: 9, o: "1090"}, {
                        f: "c",
                        y: 1.01,
                        z: 0.09,
                        i: "a",
                        e: 231,
                        s: 208,
                        o: "1092"
                    }, {f: "c", y: 1.02, z: 0.2, i: "a", e: 162, s: 180, o: "1089"}, {
                        f: "c",
                        y: 1.03,
                        z: 0.1,
                        i: "d",
                        e: 33,
                        s: 19,
                        o: "1090"
                    }, {f: "c", y: 1.04, z: 0.12, i: "f", e: 11, s: -1, o: "1090"}, {
                        f: "c",
                        y: 1.05,
                        z: 0.17,
                        i: "a",
                        e: 53,
                        s: 79,
                        o: "1091"
                    }, {f: "c", y: 1.05, z: 0.17, i: "a", e: 169, s: 182, o: "1096"}, {
                        f: "c",
                        y: 1.06,
                        z: 0.16,
                        i: "a",
                        e: 43,
                        s: 69,
                        o: "1095"
                    }, {f: "c", y: 1.08, z: 0.14, i: "f", e: 0, s: -89, o: "1094"}, {
                        f: "c",
                        y: 1.1,
                        z: 0.12,
                        i: "a",
                        e: 213,
                        s: 231,
                        o: "1092"
                    }, {f: "c", y: 1.13, z: 0.09, i: "d", e: 1, s: 33, o: "1090"}, {
                        y: 1.16,
                        i: "f",
                        s: 11,
                        z: 0,
                        o: "1090",
                        f: "c"
                    }, {y: 1.22, i: "d", s: 1, z: 0, o: "1090", f: "c"}, {
                        y: 1.22,
                        i: "f",
                        s: 0,
                        z: 0,
                        o: "1094",
                        f: "c"
                    }, {y: 1.22, i: "a", s: 43, z: 0, o: "1095", f: "c"}, {
                        y: 1.22,
                        i: "a",
                        s: 53,
                        z: 0,
                        o: "1091",
                        f: "c"
                    }, {y: 1.22, i: "a", s: 162, z: 0, o: "1089", f: "c"}, {
                        y: 1.22,
                        i: "a",
                        s: 169,
                        z: 0,
                        o: "1096",
                        f: "c"
                    }, {y: 1.22, i: "a", s: 213, z: 0, o: "1092", f: "c"}],
                    f: 30
                }
            },
            bZ: 180,
            O: ["1098", "1094", "1088", "1093", "1090", "1097", "1089", "1096", "1092", "1091", "1095"],
            v: {
                "1088": {
                    h: "446",
                    p: "no-repeat",
                    x: "visible",
                    a: 171,
                    q: "100% 100%",
                    b: 38,
                    j: "absolute",
                    r: "inline",
                    c: 45,
                    k: "div",
                    z: 14,
                    d: 118
                },
                "1098": {
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
                    z: 16,
                    P: 1,
                    D: "#D8DDE4",
                    a: 0,
                    aD: {a: [{b: "kTimelineDefaultIdentifier", p: 3, z: false, symbolOid: "187"}]},
                    b: 0
                },
                "1095": {
                    c: 7,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 2,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 48,
                    aL: 10,
                    b: 131
                },
                "1092": {
                    c: 7,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 4,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 218,
                    aL: 10,
                    b: 137
                },
                "1089": {
                    c: 5,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 6,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 167,
                    aL: 10,
                    b: 124
                },
                "1096": {
                    c: 5,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 5,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 174,
                    aL: 10,
                    b: 124
                },
                "1093": {
                    h: "444",
                    p: "no-repeat",
                    x: "visible",
                    a: 63,
                    q: "100% 100%",
                    b: 61,
                    j: "absolute",
                    r: "inline",
                    c: 97,
                    k: "div",
                    z: 13,
                    d: 84
                },
                "1090": {
                    c: 46,
                    d: 1,
                    I: "None",
                    J: "None",
                    f: 0,
                    K: "None",
                    g: "#FFFFFF",
                    L: "None",
                    M: 0,
                    N: 0,
                    A: "#D8DDE4",
                    x: "visible",
                    j: "absolute",
                    B: "#D8DDE4",
                    k: "div",
                    O: 0,
                    C: "#D8DDE4",
                    z: 12,
                    P: 0,
                    D: "#D8DDE4",
                    a: 171,
                    b: 61
                },
                "1097": {
                    h: "453",
                    p: "no-repeat",
                    x: "visible",
                    a: 172,
                    q: "100% 100%",
                    b: 62,
                    j: "absolute",
                    r: "inline",
                    c: 42,
                    k: "div",
                    z: 11,
                    d: 93
                },
                "1094": {
                    h: "164",
                    p: "no-repeat",
                    x: "visible",
                    a: 142,
                    q: "100% 100%",
                    b: 30,
                    j: "absolute",
                    r: "inline",
                    c: 18,
                    k: "div",
                    z: 15,
                    d: 19,
                    f: 0
                },
                "1091": {
                    c: 12,
                    d: 2,
                    I: "None",
                    J: "None",
                    K: "None",
                    g: "#252525",
                    L: "None",
                    M: 0,
                    N: 0,
                    aI: 10,
                    A: "#D8DDE4",
                    x: "visible",
                    j: "absolute",
                    O: 0,
                    aJ: 10,
                    k: "div",
                    C: "#D8DDE4",
                    z: 3,
                    B: "#D8DDE4",
                    D: "#D8DDE4",
                    aK: 10,
                    P: 0,
                    a: 58,
                    aL: 10,
                    b: 131
                }
            }
        }], {}, g, {}, null, false, true, -1, true, true, false, true);
        f[c] = a.API;
        document.getElementById(e).setAttribute("HYP_dn",
            c);
        a.z_o(this.body)
    })();
})();

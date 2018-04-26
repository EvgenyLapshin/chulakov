//	HYPE.documents["Прочее"]

(function () {
    (function k() {
        function l(a, b, d) {
            var c = !1;
            null == window[a] && (null == window[b] ? (window[b] = [], window[b].push(k), a = document.getElementsByTagName("head")[0], b = document.createElement("script"), c = h, false == !0 && (c = ""), b.type = "text/javascript", b.src = c + "/" + d, a.appendChild(b)) : window[b].push(k), c = !0);
            return c
        }

        var h = "/dist/home/more/", c = "Прочее", e = "прочее_hype_container";
        if (false == !1)try {
            for (var f = document.getElementsByTagName("script"),
                     a = 0; a < f.length; a++) {
                var b = f[a].src;
                if (null != b && -1 != b.indexOf("more_hype_generated_script.js")) {
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
            "7": {p: 1, n: "Oval%20medium%201.svg", g: "178", t: "image/svg+xml"},
            "3": {p: 1, n: "Oval%20big%201.svg", g: "170", t: "image/svg+xml"},
            "8": {p: 1, n: "Oval%20medium%202.svg", g: "180", t: "image/svg+xml"},
            "4": {p: 1, n: "Oval%20big%202.svg", g: "172", t: "image/svg+xml"},
            "0": {p: 1, n: "Group%202.svg", g: "164", t: "image/svg+xml"},
            "5": {p: 1, n: "Oval%20little%201.svg", g: "174", t: "image/svg+xml"},
            "1": {p: 1, n: "Group%203.svg", g: "166", t: "image/svg+xml"},
            "6": {p: 1, n: "Oval%20little%202.svg", g: "176", t: "image/svg+xml"},
            "2": {p: 1, n: "Group.svg", g: "168", t: "image/svg+xml"}
        }, h, [], d, [{
            n: "\u041f\u0440\u043e\u0447\u0435\u0435",
            o: "125",
            X: [0]
        }], [{
            A: {a: [{b: "kTimelineDefaultIdentifier", symbolOid: "126", p: 7}]},
            o: "127",
            p: "600px",
            x: 0,
            cA: false,
            Z: 200,
            Y: 270,
            c: "#f5f5f5",
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
                    a: [{f: "c", y: 0, z: 0.2, i: "f", e: 103, s: 0, o: "1095"}, {
                        f: "c",
                        y: 0,
                        z: 0.14,
                        i: "a",
                        e: 152,
                        s: 152,
                        o: "1088"
                    }, {f: "c", y: 0, z: 0.14, i: "b", e: 115, s: 135, o: "1088"}, {
                        f: "c",
                        y: 0,
                        z: 0.16,
                        i: "f",
                        e: 59,
                        s: 0,
                        o: "1090"
                    }, {f: "c", y: 0, z: 1.02, i: "a", e: 168, s: 168, o: "1094"}, {
                        f: "c",
                        y: 0,
                        z: 0.16,
                        i: "b",
                        e: 11,
                        s: 42,
                        o: "1094"
                    }, {f: "c", y: 0, z: 0.11, i: "b", e: 151, s: 145, o: "1089"}, {
                        f: "c",
                        y: 0,
                        z: 1,
                        i: "a",
                        e: 123,
                        s: 123,
                        o: "1092"
                    }, {f: "c", y: 0, z: 1.17, i: "f", e: 360, s: 0, o: "1093"}, {
                        f: "c",
                        y: 0,
                        z: 0.14,
                        i: "b",
                        e: 59,
                        s: 44,
                        o: "1092"
                    }, {f: "c", y: 0, z: 0.18, i: "a", e: 117, s: 117, o: "1093"}, {
                        f: "c",
                        y: 0,
                        z: 0.21,
                        i: "b",
                        e: 43,
                        s: 67,
                        o: "1097"
                    }, {f: "c", y: 0, z: 0.18, i: "b", e: 74, s: 87, o: "1093"}, {
                        f: "c",
                        y: 0,
                        z: 0.11,
                        i: "b",
                        e: 94,
                        s: 110,
                        o: "1091"
                    }, {y: 0.11, i: "a", s: 93, z: 0, o: "1089", f: "c"}, {
                        y: 0.11,
                        i: "a",
                        s: 104,
                        z: 0,
                        o: "1091",
                        f: "c"
                    }, {f: "c", y: 0.11, z: 0.17, i: "b", e: 129, s: 151, o: "1089"}, {
                        f: "c",
                        y: 0.11,
                        z: 0.17,
                        i: "b",
                        e: 118,
                        s: 94,
                        o: "1091"
                    }, {y: 0.14, i: "a", s: 152, z: 0, o: "1088", f: "c"}, {
                        f: "c",
                        y: 0.14,
                        z: 0.16,
                        i: "b",
                        e: 140,
                        s: 115,
                        o: "1088"
                    }, {f: "c", y: 0.14, z: 0.16, i: "b", e: 23, s: 59, o: "1092"}, {
                        f: "c",
                        y: 0.16,
                        z: 0.18,
                        i: "f",
                        e: -71,
                        s: 59,
                        o: "1090"
                    }, {f: "c", y: 0.16, z: 0.16, i: "b", e: 57, s: 11, o: "1094"}, {
                        y: 0.18,
                        i: "a",
                        s: 117,
                        z: 0,
                        o: "1093",
                        f: "c"
                    }, {f: "c", y: 0.18, z: 0.18, i: "b", e: 96, s: 74, o: "1093"}, {
                        f: "c",
                        y: 0.2,
                        z: 0.18,
                        i: "f",
                        e: -89,
                        s: 103,
                        o: "1095"
                    }, {y: 0.21, i: "a", s: 155, z: 0, o: "1097", f: "c"}, {
                        f: "c",
                        y: 0.21,
                        z: 0.09,
                        i: "b",
                        e: 80,
                        s: 43,
                        o: "1097"
                    }, {f: "c", y: 0.28, z: 0.19, i: "b", e: 145, s: 129, o: "1089"}, {
                        f: "c",
                        y: 0.28,
                        z: 0.19,
                        i: "b",
                        e: 110,
                        s: 118,
                        o: "1091"
                    }, {y: 1, i: "a", s: 123, z: 0, o: "1092", f: "c"}, {
                        f: "c",
                        y: 1,
                        z: 0.12,
                        i: "b",
                        e: 135,
                        s: 140,
                        o: "1088"
                    }, {f: "c", y: 1, z: 0.12, i: "b", e: 44, s: 23, o: "1092"}, {
                        f: "c",
                        y: 1,
                        z: 0.12,
                        i: "b",
                        e: 67,
                        s: 80,
                        o: "1097"
                    }, {f: "c", y: 1.02, z: 0.1, i: "a", e: 168, s: 168, o: "1094"}, {
                        f: "c",
                        y: 1.02,
                        z: 0.1,
                        i: "b",
                        e: 42,
                        s: 57,
                        o: "1094"
                    }, {f: "c", y: 1.04, z: 0.13, i: "f", e: 0, s: -71, o: "1090"}, {
                        f: "c",
                        y: 1.06,
                        z: 0.11,
                        i: "b",
                        e: 87,
                        s: 96,
                        o: "1093"
                    }, {f: "c", y: 1.08, z: 0.14, i: "f", e: 0, s: -89, o: "1095"}, {
                        y: 1.12,
                        i: "a",
                        s: 168,
                        z: 0,
                        o: "1094",
                        f: "c"
                    }, {y: 1.12, i: "b", s: 135, z: 0, o: "1088", f: "c"}, {
                        y: 1.12,
                        i: "b",
                        s: 42,
                        z: 0,
                        o: "1094",
                        f: "c"
                    }, {y: 1.12, i: "b", s: 44, z: 0, o: "1092", f: "c"}, {
                        y: 1.12,
                        i: "b",
                        s: 67,
                        z: 0,
                        o: "1097",
                        f: "c"
                    }, {y: 1.17, i: "f", s: 360, z: 0, o: "1093", f: "c"}, {
                        y: 1.17,
                        i: "f",
                        s: 0,
                        z: 0,
                        o: "1090",
                        f: "c"
                    }, {y: 1.17, i: "b", s: 87, z: 0, o: "1093", f: "c"}, {
                        y: 1.17,
                        i: "b",
                        s: 145,
                        z: 0,
                        o: "1089",
                        f: "c"
                    }, {y: 1.17, i: "b", s: 110, z: 0, o: "1091", f: "c"}, {
                        y: 1.22,
                        i: "f",
                        s: 0,
                        z: 0,
                        o: "1095",
                        f: "c"
                    }],
                    f: 30
                }
            },
            bZ: 180,
            O: ["1096", "1092", "1089", "1094", "1095", "1090", "1097", "1091", "1088", "1093"],
            v: {
                "1088": {
                    h: "170",
                    p: "no-repeat",
                    x: "visible",
                    a: 152,
                    q: "100% 100%",
                    b: 135,
                    j: "absolute",
                    r: "inline",
                    c: 23,
                    k: "div",
                    z: 3,
                    d: 23
                },
                "1095": {
                    h: "164",
                    p: "no-repeat",
                    x: "visible",
                    a: 78,
                    q: "100% 100%",
                    b: 81,
                    j: "absolute",
                    r: "inline",
                    c: 18,
                    k: "div",
                    z: 16,
                    d: 19,
                    f: 0
                },
                "1092": {
                    h: "178",
                    p: "no-repeat",
                    x: "visible",
                    a: 123,
                    q: "100% 100%",
                    b: 44,
                    j: "absolute",
                    r: "inline",
                    c: 16,
                    k: "div",
                    z: 20,
                    d: 15
                },
                "1089": {
                    h: "176",
                    p: "no-repeat",
                    x: "visible",
                    a: 93,
                    q: "100% 100%",
                    b: 145,
                    j: "absolute",
                    r: "inline",
                    c: 11,
                    k: "div",
                    z: 19,
                    d: 11
                },
                "1096": {
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
                    z: 21,
                    P: 1,
                    D: "#D8DDE4",
                    a: 0,
                    aD: {a: [{b: "kTimelineDefaultIdentifier", p: 3, z: false, symbolOid: "187"}]},
                    b: 0
                },
                "1093": {
                    h: "168",
                    p: "no-repeat",
                    x: "visible",
                    a: 117,
                    q: "100% 100%",
                    b: 87,
                    j: "absolute",
                    r: "inline",
                    c: 40,
                    k: "div",
                    z: 2,
                    d: 41,
                    f: 0
                },
                "1090": {
                    h: "166",
                    p: "no-repeat",
                    x: "visible",
                    a: 180,
                    q: "100% 100%",
                    b: 102,
                    j: "absolute",
                    r: "inline",
                    c: 12,
                    k: "div",
                    z: 15,
                    d: 21,
                    f: 0
                },
                "1097": {
                    h: "180",
                    p: "no-repeat",
                    x: "visible",
                    a: 155,
                    q: "100% 100%",
                    b: 67,
                    j: "absolute",
                    r: "inline",
                    c: 20,
                    k: "div",
                    z: 8,
                    d: 20
                },
                "1094": {
                    h: "174",
                    p: "no-repeat",
                    x: "visible",
                    a: 168,
                    q: "100% 100%",
                    b: 42,
                    j: "absolute",
                    r: "inline",
                    c: 11,
                    k: "div",
                    z: 17,
                    d: 10
                },
                "1091": {
                    h: "172",
                    p: "no-repeat",
                    x: "visible",
                    a: 104,
                    q: "100% 100%",
                    b: 110,
                    j: "absolute",
                    r: "inline",
                    c: 32,
                    k: "div",
                    z: 4,
                    d: 32
                }
            }
        }], {}, g, {}, null, false, true, -1, true, true, false, true);
        f[c] = a.API;
        document.getElementById(e).setAttribute("HYP_dn",
            c);
        a.z_o(this.body)
    })();
})();

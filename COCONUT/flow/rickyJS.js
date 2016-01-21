(function() {
    if (typeof jQuery != "undefined")
        var _jQuery = jQuery; var jQuery = window.jQuery = function(selector, context) { return this instanceof jQuery ? this.init(selector, context) : new jQuery(selector, context); }; if (typeof $ != "undefined")
        var _$ = $; window.$ = jQuery; var quickExpr = /^[^<]*(<(.|\s)+>)[^>]*$|^#(\w+)$/; jQuery.fn = jQuery.prototype = { init: function(selector, context) {
            selector = selector || document; if (typeof selector == "string") {
                var m = quickExpr.exec(selector); if (m && (m[1] || !context)) {
                    if (m[1])
                        selector = jQuery.clean([m[1]], context); else {
                        var tmp = document.getElementById(m[3]); if (tmp)
                            if (tmp.id != m[3])
                            return jQuery().find(selector); else { this[0] = tmp; this.length = 1; return this; }
                        else
                            selector = [];
                    } 
                } else
                    return new jQuery(context).find(selector);
            } else if (jQuery.isFunction(selector))
                return new jQuery(document)[jQuery.fn.ready ? "ready" : "load"](selector); return this.setArray(selector.constructor == Array && selector || (selector.jquery || selector.length && selector != window && !selector.nodeType && selector[0] != undefined && selector[0].nodeType) && jQuery.makeArray(selector) || [selector]);
        }, jquery: "1.2.1", size: function() { return this.length; }, length: 0, get: function(num) { return num == undefined ? jQuery.makeArray(this) : this[num]; }, pushStack: function(a) { var ret = jQuery(a); ret.prevObject = this; return ret; }, setArray: function(a) { this.length = 0; Array.prototype.push.apply(this, a); return this; }, each: function(fn, args) { return jQuery.each(this, fn, args); }, index: function(obj) { var pos = -1; this.each(function(i) { if (this == obj) pos = i; }); return pos; }, attr: function(key, value, type) {
            var obj = key; if (key.constructor == String)
                if (value == undefined)
                return this.length && jQuery[type || "attr"](this[0], key) || undefined; else { obj = {}; obj[key] = value; }
            return this.each(function(index) {
                for (var prop in obj)
                    jQuery.attr(type ? this.style : this, prop, jQuery.prop(this, obj[prop], type, index, prop));
            });
        }, css: function(key, value) { return this.attr(key, value, "curCSS"); }, text: function(e) {
            if (typeof e != "object" && e != null)
                return this.empty().append(document.createTextNode(e)); var t = ""; jQuery.each(e || this, function() {
                    jQuery.each(this.childNodes, function() {
                        if (this.nodeType != 8)
                            t += this.nodeType != 1 ? this.nodeValue : jQuery.fn.text([this]);
                    });
                }); return t;
        }, wrapAll: function(html) {
            if (this[0])
                jQuery(html, this[0].ownerDocument).clone().insertBefore(this[0]).map(function() {
                    var elem = this; while (elem.firstChild)
                        elem = elem.firstChild; return elem;
                }).append(this); return this;
        }, wrapInner: function(html) { return this.each(function() { jQuery(this).contents().wrapAll(html); }); }, wrap: function(html) { return this.each(function() { jQuery(this).wrapAll(html); }); }, append: function() { return this.domManip(arguments, true, 1, function(a) { this.appendChild(a); }); }, prepend: function() { return this.domManip(arguments, true, -1, function(a) { this.insertBefore(a, this.firstChild); }); }, before: function() { return this.domManip(arguments, false, 1, function(a) { this.parentNode.insertBefore(a, this); }); }, after: function() { return this.domManip(arguments, false, -1, function(a) { this.parentNode.insertBefore(a, this.nextSibling); }); }, end: function() { return this.prevObject || jQuery([]); }, find: function(t) { var data = jQuery.map(this, function(a) { return jQuery.find(t, a); }); return this.pushStack(/[^+>] [^+>]/.test(t) || t.indexOf("..") > -1 ? jQuery.unique(data) : data); }, clone: function(events) {
            var ret = this.map(function() { return this.outerHTML ? jQuery(this.outerHTML)[0] : this.cloneNode(true); }); var clone = ret.find("*").andSelf().each(function() {
                if (this[expando] != undefined)
                    this[expando] = null;
            }); if (events === true)
                this.find("*").andSelf().each(function(i) {
                    var events = jQuery.data(this, "events"); for (var type in events)
                        for (var handler in events[type])
                        jQuery.event.add(clone[i], type, events[type][handler], events[type][handler].data);
                }); return ret;
        }, filter: function(t) { return this.pushStack(jQuery.isFunction(t) && jQuery.grep(this, function(el, index) { return t.apply(el, [index]); }) || jQuery.multiFilter(t, this)); }, not: function(t) { return this.pushStack(t.constructor == String && jQuery.multiFilter(t, this, true) || jQuery.grep(this, function(a) { return (t.constructor == Array || t.jquery) ? jQuery.inArray(a, t) < 0 : a != t; })); }, add: function(t) { return this.pushStack(jQuery.merge(this.get(), t.constructor == String ? jQuery(t).get() : t.length != undefined && (!t.nodeName || jQuery.nodeName(t, "form")) ? t : [t])); }, is: function(expr) { return expr ? jQuery.multiFilter(expr, this).length > 0 : false; }, hasClass: function(expr) { return this.is("." + expr); }, val: function(val) {
            if (val == undefined) {
                if (this.length) {
                    var elem = this[0]; if (jQuery.nodeName(elem, "select")) {
                        var index = elem.selectedIndex, a = [], options = elem.options, one = elem.type == "select-one"; if (index < 0)
                            return null; for (var i = one ? index : 0, max = one ? index + 1 : options.length; i < max; i++) {
                            var option = options[i]; if (option.selected) {
                                var val = jQuery.browser.msie && !option.attributes["value"].specified ? option.text : option.value; if (one)
                                    return val; a.push(val);
                            } 
                        }
                        return a;
                    } else
                        return this[0].value.replace(/\r/g, "");
                } 
            } else
                return this.each(function() {
                    if (val.constructor == Array && /radio|checkbox/.test(this.type))
                        this.checked = (jQuery.inArray(this.value, val) >= 0 || jQuery.inArray(this.name, val) >= 0); else if (jQuery.nodeName(this, "select")) {
                        var tmp = val.constructor == Array ? val : [val]; jQuery("option", this).each(function() { this.selected = (jQuery.inArray(this.value, tmp) >= 0 || jQuery.inArray(this.text, tmp) >= 0); }); if (!tmp.length)
                            this.selectedIndex = -1;
                    } else
                        this.value = val;
                });
        }, html: function(val) { return val == undefined ? (this.length ? this[0].innerHTML : null) : this.empty().append(val); }, replaceWith: function(val) { return this.after(val).remove(); }, eq: function(i) { return this.slice(i, i + 1); }, slice: function() { return this.pushStack(Array.prototype.slice.apply(this, arguments)); }, map: function(fn) { return this.pushStack(jQuery.map(this, function(elem, i) { return fn.call(elem, i, elem); })); }, andSelf: function() { return this.add(this.prevObject); }, domManip: function(args, table, dir, fn) {
            var clone = this.length > 1, a; return this.each(function() {
                if (!a) {
                    a = jQuery.clean(args, this.ownerDocument); if (dir < 0)
                        a.reverse();
                }
                var obj = this; if (table && jQuery.nodeName(this, "table") && jQuery.nodeName(a[0], "tr"))
                    obj = this.getElementsByTagName("tbody")[0] || this.appendChild(document.createElement("tbody")); jQuery.each(a, function() {
                        var elem = clone ? this.cloneNode(true) : this; if (!evalScript(0, elem))
                            fn.call(obj, elem);
                    });
            });
        } 
        }; function evalScript(i, elem) {
            var script = jQuery.nodeName(elem, "script"); if (script) {
                if (elem.src)
                    jQuery.ajax({ url: elem.src, async: false, dataType: "script" }); else
                    jQuery.globalEval(elem.text || elem.textContent || elem.innerHTML || ""); if (elem.parentNode)
                    elem.parentNode.removeChild(elem);
            } else if (elem.nodeType == 1)
                jQuery("script", elem).each(evalScript); return script;
        }
    jQuery.extend = jQuery.fn.extend = function() {
        var target = arguments[0] || {}, a = 1, al = arguments.length, deep = false; if (target.constructor == Boolean) { deep = target; target = arguments[1] || {}; }
        if (al == 1) { target = this; a = 0; }
        var prop; for (; a < al; a++)
            if ((prop = arguments[a]) != null)
            for (var i in prop) {
            if (target == prop[i])
                continue; if (deep && typeof prop[i] == 'object' && target[i])
                jQuery.extend(target[i], prop[i]); else if (prop[i] != undefined)
                target[i] = prop[i];
        }
        return target;
    }; var expando = "jQuery" + (new Date()).getTime(), uuid = 0, win = {}; jQuery.extend({ noConflict: function(deep) {
        window.$ = _$; if (deep)
            window.jQuery = _jQuery; return jQuery;
    }, isFunction: function(fn) { return !!fn && typeof fn != "string" && !fn.nodeName && fn.constructor != Array && /function/i.test(fn + ""); }, isXMLDoc: function(elem) { return elem.documentElement && !elem.body || elem.tagName && elem.ownerDocument && !elem.ownerDocument.body; }, globalEval: function(data) {
        data = jQuery.trim(data); if (data) {
            if (window.execScript)
                window.execScript(data); else if (jQuery.browser.safari)
                window.setTimeout(data, 0); else
                eval.call(window, data);
        } 
    }, nodeName: function(elem, name) { return elem.nodeName && elem.nodeName.toUpperCase() == name.toUpperCase(); }, cache: {}, data: function(elem, name, data) {
        elem = elem == window ? win : elem; var id = elem[expando]; if (!id)
            id = elem[expando] = ++uuid; if (name && !jQuery.cache[id])
            jQuery.cache[id] = {}; if (data != undefined)
            jQuery.cache[id][name] = data; return name ? jQuery.cache[id][name] : id;
    }, removeData: function(elem, name) {
        elem = elem == window ? win : elem; var id = elem[expando]; if (name) {
            if (jQuery.cache[id]) {
                delete jQuery.cache[id][name]; name = ""; for (name in jQuery.cache[id]) break; if (!name)
                    jQuery.removeData(elem);
            } 
        } else {
            try { delete elem[expando]; } catch (e) {
                if (elem.removeAttribute)
                    elem.removeAttribute(expando);
            }
            delete jQuery.cache[id];
        } 
    }, each: function(obj, fn, args) {
        if (args) {
            if (obj.length == undefined)
                for (var i in obj)
                fn.apply(obj[i], args); else
                for (var i = 0, ol = obj.length; i < ol; i++)
                if (fn.apply(obj[i], args) === false) break;
        } else {
            if (obj.length == undefined)
                for (var i in obj)
                fn.call(obj[i], i, obj[i]); else
                for (var i = 0, ol = obj.length, val = obj[0]; i < ol && fn.call(val, i, val) !== false; val = obj[++i]) { } 
        }
        return obj;
    }, prop: function(elem, value, type, index, prop) {
        if (jQuery.isFunction(value))
            value = value.call(elem, [index]); var exclude = /z-?index|font-?weight|opacity|zoom|line-?height/i; return value && value.constructor == Number && type == "curCSS" && !exclude.test(prop) ? value + "px" : value;
    }, className: { add: function(elem, c) {
        jQuery.each((c || "").split(/\s+/), function(i, cur) {
            if (!jQuery.className.has(elem.className, cur))
                elem.className += (elem.className ? " " : "") + cur;
        });
    }, remove: function(elem, c) { elem.className = c != undefined ? jQuery.grep(elem.className.split(/\s+/), function(cur) { return !jQuery.className.has(c, cur); }).join(" ") : ""; }, has: function(t, c) { return jQuery.inArray(c, (t.className || t).toString().split(/\s+/)) > -1; } 
    }, swap: function(e, o, f) {
        for (var i in o) { e.style["old" + i] = e.style[i]; e.style[i] = o[i]; }
        f.apply(e, []); for (var i in o)
            e.style[i] = e.style["old" + i];
    }, css: function(e, p) {
        if (p == "height" || p == "width") {
            var old = {}, oHeight, oWidth, d = ["Top", "Bottom", "Right", "Left"]; jQuery.each(d, function() { old["padding" + this] = 0; old["border" + this + "Width"] = 0; }); jQuery.swap(e, old, function() {
                if (jQuery(e).is(':visible')) { oHeight = e.offsetHeight; oWidth = e.offsetWidth; } else {
                    e = jQuery(e.cloneNode(true)).find(":radio").removeAttr("checked").end().css({ visibility: "hidden", position: "absolute", display: "block", right: "0", left: "0" }).appendTo(e.parentNode)[0]; var parPos = jQuery.css(e.parentNode, "position") || "static"; if (parPos == "static")
                        e.parentNode.style.position = "relative"; oHeight = e.clientHeight; oWidth = e.clientWidth; if (parPos == "static")
                        e.parentNode.style.position = "static"; e.parentNode.removeChild(e);
                } 
            }); return p == "height" ? oHeight : oWidth;
        }
        return jQuery.curCSS(e, p);
    }, curCSS: function(elem, prop, force) {
        var ret, stack = [], swap = []; function color(a) {
            if (!jQuery.browser.safari)
                return false; var ret = document.defaultView.getComputedStyle(a, null); return !ret || ret.getPropertyValue("color") == "";
        }
        if (prop == "opacity" && jQuery.browser.msie) { ret = jQuery.attr(elem.style, "opacity"); return ret == "" ? "1" : ret; }
        if (prop.match(/float/i))
            prop = styleFloat; if (!force && elem.style[prop])
            ret = elem.style[prop]; else if (document.defaultView && document.defaultView.getComputedStyle) {
            if (prop.match(/float/i))
                prop = "float"; prop = prop.replace(/([A-Z])/g, "-$1").toLowerCase(); var cur = document.defaultView.getComputedStyle(elem, null); if (cur && !color(elem))
                ret = cur.getPropertyValue(prop); else {
                for (var a = elem; a && color(a); a = a.parentNode)
                    stack.unshift(a); for (a = 0; a < stack.length; a++)
                    if (color(stack[a])) { swap[a] = stack[a].style.display; stack[a].style.display = "block"; }
                ret = prop == "display" && swap[stack.length - 1] != null ? "none" : document.defaultView.getComputedStyle(elem, null).getPropertyValue(prop) || ""; for (a = 0; a < swap.length; a++)
                    if (swap[a] != null)
                    stack[a].style.display = swap[a];
            }
            if (prop == "opacity" && ret == "")
                ret = "1";
        } else if (elem.currentStyle) { var newProp = prop.replace(/\-(\w)/g, function(m, c) { return c.toUpperCase(); }); ret = elem.currentStyle[prop] || elem.currentStyle[newProp]; if (!/^\d+(px)?$/i.test(ret) && /^\d/.test(ret)) { var style = elem.style.left; var runtimeStyle = elem.runtimeStyle.left; elem.runtimeStyle.left = elem.currentStyle.left; elem.style.left = ret || 0; ret = elem.style.pixelLeft + "px"; elem.style.left = style; elem.runtimeStyle.left = runtimeStyle; } }
        return ret;
    }, clean: function(a, doc) {
        var r = []; doc = doc || document; jQuery.each(a, function(i, arg) {
            if (!arg) return; if (arg.constructor == Number)
                arg = arg.toString(); if (typeof arg == "string") {
                arg = arg.replace(/(<(\w+)[^>]*?)\/>/g, function(m, all, tag) { return tag.match(/^(abbr|br|col|img|input|link|meta|param|hr|area)$/i) ? m : all + "></" + tag + ">"; }); var s = jQuery.trim(arg).toLowerCase(), div = doc.createElement("div"), tb = []; var wrap = !s.indexOf("<opt") && [1, "<select>", "</select>"] || !s.indexOf("<leg") && [1, "<fieldset>", "</fieldset>"] || s.match(/^<(thead|tbody|tfoot|colg|cap)/) && [1, "<table>", "</table>"] || !s.indexOf("<tr") && [2, "<table><tbody>", "</tbody></table>"] || (!s.indexOf("<td") || !s.indexOf("<th")) && [3, "<table><tbody><tr>", "</tr></tbody></table>"] || !s.indexOf("<col") && [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"] || jQuery.browser.msie && [1, "div<div>", "</div>"] || [0, "", ""]; div.innerHTML = wrap[1] + arg + wrap[2]; while (wrap[0]--)
                    div = div.lastChild; if (jQuery.browser.msie) {
                    if (!s.indexOf("<table") && s.indexOf("<tbody") < 0)
                        tb = div.firstChild && div.firstChild.childNodes; else if (wrap[1] == "<table>" && s.indexOf("<tbody") < 0)
                        tb = div.childNodes; for (var n = tb.length - 1; n >= 0; --n)
                        if (jQuery.nodeName(tb[n], "tbody") && !tb[n].childNodes.length)
                        tb[n].parentNode.removeChild(tb[n]); if (/^\s/.test(arg))
                        div.insertBefore(doc.createTextNode(arg.match(/^\s*/)[0]), div.firstChild);
                }
                arg = jQuery.makeArray(div.childNodes);
            }
            if (0 === arg.length && (!jQuery.nodeName(arg, "form") && !jQuery.nodeName(arg, "select")))
                return; if (arg[0] == undefined || jQuery.nodeName(arg, "form") || arg.options)
                r.push(arg); else
                r = jQuery.merge(r, arg);
        }); return r;
    }, attr: function(elem, name, value) {
        var fix = jQuery.isXMLDoc(elem) ? {} : jQuery.props; if (name == "selected" && jQuery.browser.safari)
            elem.parentNode.selectedIndex; if (fix[name]) { if (value != undefined) elem[fix[name]] = value; return elem[fix[name]]; } else if (jQuery.browser.msie && name == "style")
            return jQuery.attr(elem.style, "cssText", value); else if (value == undefined && jQuery.browser.msie && jQuery.nodeName(elem, "form") && (name == "action" || name == "method"))
            return elem.getAttributeNode(name).nodeValue; else if (elem.tagName) {
            if (value != undefined) {
                if (name == "type" && jQuery.nodeName(elem, "input") && elem.parentNode)
                    throw "type property can't be changed"; elem.setAttribute(name, value);
            }
            if (jQuery.browser.msie && /href|src/.test(name) && !jQuery.isXMLDoc(elem))
                return elem.getAttribute(name, 2); return elem.getAttribute(name);
        } else {
            if (name == "opacity" && jQuery.browser.msie) {
                if (value != undefined) {
                    elem.zoom = 1; elem.filter = (elem.filter || "").replace(/alpha\([^)]*\)/, "") +
(parseFloat(value).toString() == "NaN" ? "" : "alpha(opacity=" + value * 100 + ")");
                }
                return elem.filter ? (parseFloat(elem.filter.match(/opacity=([^)]*)/)[1]) / 100).toString() : "";
            }
            name = name.replace(/-([a-z])/ig, function(z, b) { return b.toUpperCase(); }); if (value != undefined) elem[name] = value; return elem[name];
        } 
    }, trim: function(t) { return (t || "").replace(/^\s+|\s+$/g, ""); }, makeArray: function(a) {
        var r = []; if (typeof a != "array")
            for (var i = 0, al = a.length; i < al; i++)
            r.push(a[i]); else
            r = a.slice(0); return r;
    }, inArray: function(b, a) {
        for (var i = 0, al = a.length; i < al; i++)
            if (a[i] == b)
            return i; return -1;
    }, merge: function(first, second) {
        if (jQuery.browser.msie) {
            for (var i = 0; second[i]; i++)
                if (second[i].nodeType != 8)
                first.push(second[i]);
        } else
            for (var i = 0; second[i]; i++)
            first.push(second[i]); return first;
    }, unique: function(first) {
        var r = [], done = {}; try { for (var i = 0, fl = first.length; i < fl; i++) { var id = jQuery.data(first[i]); if (!done[id]) { done[id] = true; r.push(first[i]); } } } catch (e) { r = first; }
        return r;
    }, grep: function(elems, fn, inv) {
        if (typeof fn == "string")
            fn = eval("false||function(a,i){return " + fn + "}"); var result = []; for (var i = 0, el = elems.length; i < el; i++)
            if (!inv && fn(elems[i], i) || inv && !fn(elems[i], i))
            result.push(elems[i]); return result;
    }, map: function(elems, fn) {
        if (typeof fn == "string")
            fn = eval("false||function(a){return " + fn + "}"); var result = []; for (var i = 0, el = elems.length; i < el; i++) { var val = fn(elems[i], i); if (val !== null && val != undefined) { if (val.constructor != Array) val = [val]; result = result.concat(val); } }
        return result;
    } 
    }); var userAgent = navigator.userAgent.toLowerCase(); jQuery.browser = { version: (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1], safari: /webkit/.test(userAgent), opera: /opera/.test(userAgent), msie: /msie/.test(userAgent) && !/opera/.test(userAgent), mozilla: /mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent) }; var styleFloat = jQuery.browser.msie ? "styleFloat" : "cssFloat"; jQuery.extend({ boxModel: !jQuery.browser.msie || document.compatMode == "CSS1Compat", styleFloat: jQuery.browser.msie ? "styleFloat" : "cssFloat", props: { "for": "htmlFor", "class": "className", "float": styleFloat, cssFloat: styleFloat, styleFloat: styleFloat, innerHTML: "innerHTML", className: "className", value: "value", disabled: "disabled", checked: "checked", readonly: "readOnly", selected: "selected", maxlength: "maxLength"} }); jQuery.each({ parent: "a.parentNode", parents: "jQuery.dir(a,'parentNode')", next: "jQuery.nth(a,2,'nextSibling')", prev: "jQuery.nth(a,2,'previousSibling')", nextAll: "jQuery.dir(a,'nextSibling')", prevAll: "jQuery.dir(a,'previousSibling')", siblings: "jQuery.sibling(a.parentNode.firstChild,a)", children: "jQuery.sibling(a.firstChild)", contents: "jQuery.nodeName(a,'iframe')?a.contentDocument||a.contentWindow.document:jQuery.makeArray(a.childNodes)" }, function(i, n) {
        jQuery.fn[i] = function(a) {
            var ret = jQuery.map(this, n); if (a && typeof a == "string")
                ret = jQuery.multiFilter(a, ret); return this.pushStack(jQuery.unique(ret));
        };
    }); jQuery.each({ appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith" }, function(i, n) {
        jQuery.fn[i] = function() {
            var a = arguments; return this.each(function() {
                for (var j = 0, al = a.length; j < al; j++)
                    jQuery(a[j])[n](this);
            });
        };
    }); jQuery.each({ removeAttr: function(key) { jQuery.attr(this, key, ""); this.removeAttribute(key); }, addClass: function(c) { jQuery.className.add(this, c); }, removeClass: function(c) { jQuery.className.remove(this, c); }, toggleClass: function(c) { jQuery.className[jQuery.className.has(this, c) ? "remove" : "add"](this, c); }, remove: function(a) { if (!a || jQuery.filter(a, [this]).r.length) { jQuery.removeData(this); this.parentNode.removeChild(this); } }, empty: function() {
        jQuery("*", this).each(function() { jQuery.removeData(this); }); while (this.firstChild)
            this.removeChild(this.firstChild);
    } 
    }, function(i, n) { jQuery.fn[i] = function() { return this.each(n, arguments); }; }); jQuery.each(["Height", "Width"], function(i, name) { var n = name.toLowerCase(); jQuery.fn[n] = function(h) { return this[0] == window ? jQuery.browser.safari && self["inner" + name] || jQuery.boxModel && Math.max(document.documentElement["client" + name], document.body["client" + name]) || document.body["client" + name] : this[0] == document ? Math.max(document.body["scroll" + name], document.body["offset" + name]) : h == undefined ? (this.length ? jQuery.css(this[0], n) : null) : this.css(n, h.constructor == String ? h : h + "px"); }; }); var chars = jQuery.browser.safari && parseInt(jQuery.browser.version) < 417 ? "(?:[\\w*_-]|\\\\.)" : "(?:[\\w\u0128-\uFFFF*_-]|\\\\.)", quickChild = new RegExp("^>\\s*(" + chars + "+)"), quickID = new RegExp("^(" + chars + "+)(#)(" + chars + "+)"), quickClass = new RegExp("^([#.]?)(" + chars + "*)"); jQuery.extend({ expr: { "": "m[2]=='*'||jQuery.nodeName(a,m[2])", "#": "a.getAttribute('id')==m[2]", ":": { lt: "i<m[3]-0", gt: "i>m[3]-0", nth: "m[3]-0==i", eq: "m[3]-0==i", first: "i==0", last: "i==r.length-1", even: "i%2==0", odd: "i%2", "first-child": "a.parentNode.getElementsByTagName('*')[0]==a", "last-child": "jQuery.nth(a.parentNode.lastChild,1,'previousSibling')==a", "only-child": "!jQuery.nth(a.parentNode.lastChild,2,'previousSibling')", parent: "a.firstChild", empty: "!a.firstChild", contains: "(a.textContent||a.innerText||jQuery(a).text()||'').indexOf(m[3])>=0", visible: '"hidden"!=a.type&&jQuery.css(a,"display")!="none"&&jQuery.css(a,"visibility")!="hidden"', hidden: '"hidden"==a.type||jQuery.css(a,"display")=="none"||jQuery.css(a,"visibility")=="hidden"', enabled: "!a.disabled", disabled: "a.disabled", checked: "a.checked", selected: "a.selected||jQuery.attr(a,'selected')", text: "'text'==a.type", radio: "'radio'==a.type", checkbox: "'checkbox'==a.type", file: "'file'==a.type", password: "'password'==a.type", submit: "'submit'==a.type", image: "'image'==a.type", reset: "'reset'==a.type", button: '"button"==a.type||jQuery.nodeName(a,"button")', input: "/input|select|textarea|button/i.test(a.nodeName)", has: "jQuery.find(m[3],a).length", header: "/h\\d/i.test(a.nodeName)", animated: "jQuery.grep(jQuery.timers,function(fn){return a==fn.elem;}).length"} }, parse: [/^(\[) *@?([\w-]+) *([!*$^~=]*) *('?"?)(.*?)\4 *\]/, /^(:)([\w-]+)\("?'?(.*?(\(.*?\))?[^(]*?)"?'?\)/, new RegExp("^([:.#]*)(" + chars + "+)")], multiFilter: function(expr, elems, not) {
        var old, cur = []; while (expr && expr != old) { old = expr; var f = jQuery.filter(expr, elems, not); expr = f.t.replace(/^\s*,\s*/, ""); cur = not ? elems = f.r : jQuery.merge(cur, f.r); }
        return cur;
    }, find: function(t, context) {
        if (typeof t != "string")
            return [t]; if (context && !context.nodeType)
            context = null; context = context || document; var ret = [context], done = [], last; while (t && last != t) {
            var r = []; last = t; t = jQuery.trim(t); var foundToken = false; var re = quickChild; var m = re.exec(t); if (m) {
                var nodeName = m[1].toUpperCase(); for (var i = 0; ret[i]; i++)
                    for (var c = ret[i].firstChild; c; c = c.nextSibling)
                    if (c.nodeType == 1 && (nodeName == "*" || c.nodeName.toUpperCase() == nodeName.toUpperCase()))
                    r.push(c); ret = r; t = t.replace(re, ""); if (t.indexOf(" ") == 0) continue; foundToken = true;
            } else {
                re = /^([>+~])\s*(\w*)/i; if ((m = re.exec(t)) != null) {
                    r = []; var nodeName = m[2], merge = {}; m = m[1]; for (var j = 0, rl = ret.length; j < rl; j++) {
                        var n = m == "~" || m == "+" ? ret[j].nextSibling : ret[j].firstChild; for (; n; n = n.nextSibling)
                            if (n.nodeType == 1) {
                            var id = jQuery.data(n); if (m == "~" && merge[id]) break; if (!nodeName || n.nodeName.toUpperCase() == nodeName.toUpperCase()) { if (m == "~") merge[id] = true; r.push(n); }
                            if (m == "+") break;
                        } 
                    }
                    ret = r; t = jQuery.trim(t.replace(re, "")); foundToken = true;
                } 
            }
            if (t && !foundToken) {
                if (!t.indexOf(",")) { if (context == ret[0]) ret.shift(); done = jQuery.merge(done, ret); r = ret = [context]; t = " " + t.substr(1, t.length); } else {
                    var re2 = quickID; var m = re2.exec(t); if (m) { m = [0, m[2], m[3], m[1]]; } else { re2 = quickClass; m = re2.exec(t); }
                    m[2] = m[2].replace(/\\/g, ""); var elem = ret[ret.length - 1]; if (m[1] == "#" && elem && elem.getElementById && !jQuery.isXMLDoc(elem)) {
                        var oid = elem.getElementById(m[2]); if ((jQuery.browser.msie || jQuery.browser.opera) && oid && typeof oid.id == "string" && oid.id != m[2])
                            oid = jQuery('[@id="' + m[2] + '"]', elem)[0]; ret = r = oid && (!m[3] || jQuery.nodeName(oid, m[3])) ? [oid] : [];
                    } else {
                        for (var i = 0; ret[i]; i++) {
                            var tag = m[1] == "#" && m[3] ? m[3] : m[1] != "" || m[0] == "" ? "*" : m[2]; if (tag == "*" && ret[i].nodeName.toLowerCase() == "object")
                                tag = "param"; r = jQuery.merge(r, ret[i].getElementsByTagName(tag));
                        }
                        if (m[1] == ".")
                            r = jQuery.classFilter(r, m[2]); if (m[1] == "#") {
                            var tmp = []; for (var i = 0; r[i]; i++)
                                if (r[i].getAttribute("id") == m[2]) { tmp = [r[i]]; break; }
                            r = tmp;
                        }
                        ret = r;
                    }
                    t = t.replace(re2, "");
                } 
            }
            if (t) { var val = jQuery.filter(t, r); ret = r = val.r; t = jQuery.trim(val.t); } 
        }
        if (t)
            ret = []; if (ret && context == ret[0])
            ret.shift(); done = jQuery.merge(done, ret); return done;
    }, classFilter: function(r, m, not) {
        m = " " + m + " "; var tmp = []; for (var i = 0; r[i]; i++) {
            var pass = (" " + r[i].className + " ").indexOf(m) >= 0; if (!not && pass || not && !pass)
                tmp.push(r[i]);
        }
        return tmp;
    }, filter: function(t, r, not) {
        var last; while (t && t != last) {
            last = t; var p = jQuery.parse, m; for (var i = 0; p[i]; i++) { m = p[i].exec(t); if (m) { t = t.substring(m[0].length); m[2] = m[2].replace(/\\/g, ""); break; } }
            if (!m)
                break; if (m[1] == ":" && m[2] == "not")
                r = jQuery.filter(m[3], r, true).r; else if (m[1] == ".")
                r = jQuery.classFilter(r, m[2], not); else if (m[1] == "[") {
                var tmp = [], type = m[3]; for (var i = 0, rl = r.length; i < rl; i++) {
                    var a = r[i], z = a[jQuery.props[m[2]] || m[2]]; if (z == null || /href|src|selected/.test(m[2]))
                        z = jQuery.attr(a, m[2]) || ''; if ((type == "" && !!z || type == "=" && z == m[5] || type == "!=" && z != m[5] || type == "^=" && z && !z.indexOf(m[5]) || type == "$=" && z.substr(z.length - m[5].length) == m[5] || (type == "*=" || type == "~=") && z.indexOf(m[5]) >= 0) ^ not)
                        tmp.push(a);
                }
                r = tmp;
            } else if (m[1] == ":" && m[2] == "nth-child") {
                var merge = {}, tmp = [], test = /(\d*)n\+?(\d*)/.exec(m[3] == "even" && "2n" || m[3] == "odd" && "2n+1" || !/\D/.test(m[3]) && "n+" + m[3] || m[3]), first = (test[1] || 1) - 0, last = test[2] - 0; for (var i = 0, rl = r.length; i < rl; i++) {
                    var node = r[i], parentNode = node.parentNode, id = jQuery.data(parentNode); if (!merge[id]) {
                        var c = 1; for (var n = parentNode.firstChild; n; n = n.nextSibling)
                            if (n.nodeType == 1)
                            n.nodeIndex = c++; merge[id] = true;
                    }
                    var add = false; if (first == 1) {
                        if (last == 0 || node.nodeIndex == last)
                            add = true;
                    } else if ((node.nodeIndex + last) % first == 0)
                        add = true; if (add ^ not)
                        tmp.push(node);
                }
                r = tmp;
            } else {
                var f = jQuery.expr[m[1]]; if (typeof f != "string")
                    f = jQuery.expr[m[1]][m[2]]; f = eval("false||function(a,i){return " + f + "}"); r = jQuery.grep(r, f, not);
            } 
        }
        return { r: r, t: t };
    }, dir: function(elem, dir) {
        var matched = []; var cur = elem[dir]; while (cur && cur != document) {
            if (cur.nodeType == 1)
                matched.push(cur); cur = cur[dir];
        }
        return matched;
    }, nth: function(cur, result, dir, elem) {
        result = result || 1; var num = 0; for (; cur; cur = cur[dir])
            if (cur.nodeType == 1 && ++num == result)
            break; return cur;
    }, sibling: function(n, elem) {
        var r = []; for (; n; n = n.nextSibling) {
            if (n.nodeType == 1 && (!elem || n != elem))
                r.push(n);
        }
        return r;
    } 
    }); jQuery.event = { add: function(element, type, handler, data) {
        if (jQuery.browser.msie && element.setInterval != undefined)
            element = window; if (!handler.guid)
            handler.guid = this.guid++; if (data != undefined) { var fn = handler; handler = function() { return fn.apply(this, arguments); }; handler.data = data; handler.guid = fn.guid; }
        var parts = type.split("."); type = parts[0]; handler.type = parts[1]; var events = jQuery.data(element, "events") || jQuery.data(element, "events", {}); var handle = jQuery.data(element, "handle", function() {
            var val; if (typeof jQuery == "undefined" || jQuery.event.triggered)
                return val; val = jQuery.event.handle.apply(element, arguments); return val;
        }); var handlers = events[type]; if (!handlers) {
            handlers = events[type] = {}; if (element.addEventListener)
                element.addEventListener(type, handle, false); else
                element.attachEvent("on" + type, handle);
        }
        handlers[handler.guid] = handler; this.global[type] = true;
    }, guid: 1, global: {}, remove: function(element, type, handler) {
        var events = jQuery.data(element, "events"), ret, index; if (typeof type == "string") { var parts = type.split("."); type = parts[0]; }
        if (events) {
            if (type && type.type) { handler = type.handler; type = type.type; }
            if (!type) {
                for (type in events)
                    this.remove(element, type);
            } else if (events[type]) {
                if (handler)
                    delete events[type][handler.guid]; else
                    for (handler in events[type])
                    if (!parts[1] || events[type][handler].type == parts[1])
                    delete events[type][handler]; for (ret in events[type]) break; if (!ret) {
                    if (element.removeEventListener)
                        element.removeEventListener(type, jQuery.data(element, "handle"), false); else
                        element.detachEvent("on" + type, jQuery.data(element, "handle")); ret = null; delete events[type];
                } 
            }
            for (ret in events) break; if (!ret) { jQuery.removeData(element, "events"); jQuery.removeData(element, "handle"); } 
        } 
    }, trigger: function(type, data, element, donative, extra) {
        data = jQuery.makeArray(data || []); if (!element) {
            if (this.global[type])
                jQuery("*").add([window, document]).trigger(type, data);
        } else {
            var val, ret, fn = jQuery.isFunction(element[type] || null), evt = !data[0] || !data[0].preventDefault; if (evt)
                data.unshift(this.fix({ type: type, target: element })); data[0].type = type; if (jQuery.isFunction(jQuery.data(element, "handle")))
                val = jQuery.data(element, "handle").apply(element, data); if (!fn && element["on" + type] && element["on" + type].apply(element, data) === false)
                val = false; if (evt)
                data.shift(); if (extra && extra.apply(element, data) === false)
                val = false; if (fn && donative !== false && val !== false && !(jQuery.nodeName(element, 'a') && type == "click")) { this.triggered = true; element[type](); }
            this.triggered = false;
        }
        return val;
    }, handle: function(event) {
        var val; event = jQuery.event.fix(event || window.event || {}); var parts = event.type.split("."); event.type = parts[0]; var c = jQuery.data(this, "events") && jQuery.data(this, "events")[event.type], args = Array.prototype.slice.call(arguments, 1); args.unshift(event); for (var j in c) {
            args[0].handler = c[j]; args[0].data = c[j].data; if (!parts[1] || c[j].type == parts[1]) {
                var tmp = c[j].apply(this, args); if (val !== false)
                    val = tmp; if (tmp === false) { event.preventDefault(); event.stopPropagation(); } 
            } 
        }
        if (jQuery.browser.msie)
            event.target = event.preventDefault = event.stopPropagation = event.handler = event.data = null; return val;
    }, fix: function(event) {
        var originalEvent = event; event = jQuery.extend({}, originalEvent); event.preventDefault = function() {
            if (originalEvent.preventDefault)
                originalEvent.preventDefault(); originalEvent.returnValue = false;
        }; event.stopPropagation = function() {
            if (originalEvent.stopPropagation)
                originalEvent.stopPropagation(); originalEvent.cancelBubble = true;
        }; if (!event.target && event.srcElement)
            event.target = event.srcElement; if (jQuery.browser.safari && event.target.nodeType == 3)
            event.target = originalEvent.target.parentNode; if (!event.relatedTarget && event.fromElement)
            event.relatedTarget = event.fromElement == event.target ? event.toElement : event.fromElement; if (event.pageX == null && event.clientX != null) { var e = document.documentElement, b = document.body; event.pageX = event.clientX + (e && e.scrollLeft || b.scrollLeft || 0); event.pageY = event.clientY + (e && e.scrollTop || b.scrollTop || 0); }
        if (!event.which && (event.charCode || event.keyCode))
            event.which = event.charCode || event.keyCode; if (!event.metaKey && event.ctrlKey)
            event.metaKey = event.ctrlKey; if (!event.which && event.button)
            event.which = (event.button & 1 ? 1 : (event.button & 2 ? 3 : (event.button & 4 ? 2 : 0))); return event;
    } 
    }; jQuery.fn.extend({ bind: function(type, data, fn) { return type == "unload" ? this.one(type, data, fn) : this.each(function() { jQuery.event.add(this, type, fn || data, fn && data); }); }, one: function(type, data, fn) { return this.each(function() { jQuery.event.add(this, type, function(event) { jQuery(this).unbind(event); return (fn || data).apply(this, arguments); }, fn && data); }); }, unbind: function(type, fn) { return this.each(function() { jQuery.event.remove(this, type, fn); }); }, trigger: function(type, data, fn) { return this.each(function() { jQuery.event.trigger(type, data, this, true, fn); }); }, triggerHandler: function(type, data, fn) {
        if (this[0])
            return jQuery.event.trigger(type, data, this[0], false, fn);
    }, toggle: function() { var a = arguments; return this.click(function(e) { this.lastToggle = 0 == this.lastToggle ? 1 : 0; e.preventDefault(); return a[this.lastToggle].apply(this, [e]) || false; }); }, hover: function(f, g) {
        function handleHover(e) { var p = e.relatedTarget; while (p && p != this) try { p = p.parentNode; } catch (e) { p = this; }; if (p == this) return false; return (e.type == "mouseover" ? f : g).apply(this, [e]); }
        return this.mouseover(handleHover).mouseout(handleHover);
    }, ready: function(f) {
        bindReady(); if (jQuery.isReady)
            f.apply(document, [jQuery]); else
            jQuery.readyList.push(function() { return f.apply(this, [jQuery]); }); return this;
    } 
    }); jQuery.extend({ isReady: false, readyList: [], ready: function() {
        if (!jQuery.isReady) {
            jQuery.isReady = true; if (jQuery.readyList) { jQuery.each(jQuery.readyList, function() { this.apply(document); }); jQuery.readyList = null; }
            if (jQuery.browser.mozilla || jQuery.browser.opera)
                document.removeEventListener("DOMContentLoaded", jQuery.ready, false); if (!window.frames.length)
                jQuery(window).load(function() { jQuery("#__ie_init").remove(); });
        } 
    } 
    }); jQuery.each(("blur,focus,load,resize,scroll,unload,click,dblclick," + "mousedown,mouseup,mousemove,mouseover,mouseout,change,select," + "submit,keydown,keypress,keyup,error").split(","), function(i, o) { jQuery.fn[o] = function(f) { return f ? this.bind(o, f) : this.trigger(o); }; }); var readyBound = false; function bindReady() {
        if (readyBound) return; readyBound = true; if (jQuery.browser.mozilla || jQuery.browser.opera)
            document.addEventListener("DOMContentLoaded", jQuery.ready, false); else if (jQuery.browser.msie) {
            document.write("<scr" + "ipt id=__ie_init defer=true " + "src=//:><\/script>"); var script = document.getElementById("__ie_init"); if (script)
                script.onreadystatechange = function() { if (this.readyState != "complete") return; jQuery.ready(); }; script = null;
        } else if (jQuery.browser.safari)
            jQuery.safariTimer = setInterval(function() { if (document.readyState == "loaded" || document.readyState == "complete") { clearInterval(jQuery.safariTimer); jQuery.safariTimer = null; jQuery.ready(); } }, 10); jQuery.event.add(window, "load", jQuery.ready);
    }
    jQuery.fn.extend({ load: function(url, params, callback) {
        if (jQuery.isFunction(url))
            return this.bind("load", url); var off = url.indexOf(" "); if (off >= 0) { var selector = url.slice(off, url.length); url = url.slice(0, off); }
        callback = callback || function() { }; var type = "GET"; if (params)
            if (jQuery.isFunction(params)) { callback = params; params = null; } else { params = jQuery.param(params); type = "POST"; }
        var self = this; jQuery.ajax({ url: url, type: type, data: params, complete: function(res, status) {
            if (status == "success" || status == "notmodified")
                self.html(selector ? jQuery("<div/>").append(res.responseText.replace(/<script(.|\s)*?\/script>/g, "")).find(selector) : res.responseText); setTimeout(function() { self.each(callback, [res.responseText, status, res]); }, 13);
        } 
        }); return this;
    }, serialize: function() { return jQuery.param(this.serializeArray()); }, serializeArray: function() { return this.map(function() { return jQuery.nodeName(this, "form") ? jQuery.makeArray(this.elements) : this; }).filter(function() { return this.name && !this.disabled && (this.checked || /select|textarea/i.test(this.nodeName) || /text|hidden|password/i.test(this.type)); }).map(function(i, elem) { var val = jQuery(this).val(); return val == null ? null : val.constructor == Array ? jQuery.map(val, function(val, i) { return { name: elem.name, value: val }; }) : { name: elem.name, value: val }; }).get(); } 
    }); jQuery.each("ajaxStart,ajaxStop,ajaxComplete,ajaxError,ajaxSuccess,ajaxSend".split(","), function(i, o) { jQuery.fn[o] = function(f) { return this.bind(o, f); }; }); var jsc = (new Date).getTime(); jQuery.extend({ get: function(url, data, callback, type) {
        if (jQuery.isFunction(data)) { callback = data; data = null; }
        return jQuery.ajax({ type: "GET", url: url, data: data, success: callback, dataType: type });
    }, getScript: function(url, callback) { return jQuery.get(url, null, callback, "script"); }, getJSON: function(url, data, callback) { return jQuery.get(url, data, callback, "json"); }, post: function(url, data, callback, type) {
        if (jQuery.isFunction(data)) { callback = data; data = {}; }
        return jQuery.ajax({ type: "POST", url: url, data: data, success: callback, dataType: type });
    }, ajaxSetup: function(settings) { jQuery.extend(jQuery.ajaxSettings, settings); }, ajaxSettings: { global: true, type: "GET", timeout: 0, contentType: "application/x-www-form-urlencoded", processData: true, async: true, data: null }, lastModified: {}, ajax: function(s) {
        var jsonp, jsre = /=(\?|%3F)/g, status, data; s = jQuery.extend(true, s, jQuery.extend(true, {}, jQuery.ajaxSettings, s)); if (s.data && s.processData && typeof s.data != "string")
            s.data = jQuery.param(s.data); if (s.dataType == "jsonp") {
            if (s.type.toLowerCase() == "get") {
                if (!s.url.match(jsre))
                    s.url += (s.url.match(/\?/) ? "&" : "?") + (s.jsonp || "callback") + "=?";
            } else if (!s.data || !s.data.match(jsre))
                s.data = (s.data ? s.data + "&" : "") + (s.jsonp || "callback") + "=?"; s.dataType = "json";
        }
        if (s.dataType == "json" && (s.data && s.data.match(jsre) || s.url.match(jsre))) {
            jsonp = "jsonp" + jsc++; if (s.data)
                s.data = s.data.replace(jsre, "=" + jsonp); s.url = s.url.replace(jsre, "=" + jsonp); s.dataType = "script"; window[jsonp] = function(tmp) { data = tmp; success(); complete(); window[jsonp] = undefined; try { delete window[jsonp]; } catch (e) { } };
        }
        if (s.dataType == "script" && s.cache == null)
            s.cache = false; if (s.cache === false && s.type.toLowerCase() == "get")
            s.url += (s.url.match(/\?/) ? "&" : "?") + "_=" + (new Date()).getTime(); if (s.data && s.type.toLowerCase() == "get") { s.url += (s.url.match(/\?/) ? "&" : "?") + s.data; s.data = null; }
        if (s.global && !jQuery.active++)
            jQuery.event.trigger("ajaxStart"); if (!s.url.indexOf("http") && s.dataType == "script") {
            var head = document.getElementsByTagName("head")[0]; var script = document.createElement("script"); script.src = s.url; if (!jsonp && (s.success || s.complete)) { var done = false; script.onload = script.onreadystatechange = function() { if (!done && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete")) { done = true; success(); complete(); head.removeChild(script); } }; }
            head.appendChild(script); return;
        }
        var requestDone = false; var xml = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest(); xml.open(s.type, s.url, s.async); if (s.data)
            xml.setRequestHeader("Content-Type", s.contentType); if (s.ifModified)
            xml.setRequestHeader("If-Modified-Since", jQuery.lastModified[s.url] || "Thu, 01 Jan 1970 00:00:00 GMT"); xml.setRequestHeader("X-Requested-With", "XMLHttpRequest"); if (s.beforeSend)
            s.beforeSend(xml); if (s.global)
            jQuery.event.trigger("ajaxSend", [xml, s]); var onreadystatechange = function(isTimeout) {
                if (!requestDone && xml && (xml.readyState == 4 || isTimeout == "timeout")) {
                    requestDone = true; if (ival) { clearInterval(ival); ival = null; }
                    status = isTimeout == "timeout" && "timeout" || !jQuery.httpSuccess(xml) && "error" || s.ifModified && jQuery.httpNotModified(xml, s.url) && "notmodified" || "success"; if (status == "success") { try { data = jQuery.httpData(xml, s.dataType); } catch (e) { status = "parsererror"; } }
                    if (status == "success") {
                        var modRes; try { modRes = xml.getResponseHeader("Last-Modified"); } catch (e) { }
                        if (s.ifModified && modRes)
                            jQuery.lastModified[s.url] = modRes; if (!jsonp)
                            success();
                    } else
                        jQuery.handleError(s, xml, status); complete(); if (s.async)
                        xml = null;
                } 
            }; if (s.async) {
            var ival = setInterval(onreadystatechange, 13); if (s.timeout > 0)
                setTimeout(function() {
                    if (xml) {
                        xml.abort(); if (!requestDone)
                            onreadystatechange("timeout");
                    } 
                }, s.timeout);
        }
        try { xml.send(s.data); } catch (e) { jQuery.handleError(s, xml, null, e); }
        if (!s.async)
            onreadystatechange(); return xml; function success() {
                if (s.success)
                    s.success(data, status); if (s.global)
                    jQuery.event.trigger("ajaxSuccess", [xml, s]);
            }
        function complete() {
            if (s.complete)
                s.complete(xml, status); if (s.global)
                jQuery.event.trigger("ajaxComplete", [xml, s]); if (s.global && ! --jQuery.active)
                jQuery.event.trigger("ajaxStop");
        } 
    }, handleError: function(s, xml, status, e) {
        if (s.error) s.error(xml, status, e); if (s.global)
            jQuery.event.trigger("ajaxError", [xml, s, e]);
    }, active: 0, httpSuccess: function(r) {
        try { return !r.status && location.protocol == "file:" || (r.status >= 200 && r.status < 300) || r.status == 304 || jQuery.browser.safari && r.status == undefined; } catch (e) { }
        return false;
    }, httpNotModified: function(xml, url) {
        try { var xmlRes = xml.getResponseHeader("Last-Modified"); return xml.status == 304 || xmlRes == jQuery.lastModified[url] || jQuery.browser.safari && xml.status == undefined; } catch (e) { }
        return false;
    }, httpData: function(r, type) {
        var ct = r.getResponseHeader("content-type"); var xml = type == "xml" || !type && ct && ct.indexOf("xml") >= 0; var data = xml ? r.responseXML : r.responseText; if (xml && data.documentElement.tagName == "parsererror")
            throw "parsererror"; if (type == "script")
            jQuery.globalEval(data); if (type == "json")
            data = eval("(" + data + ")"); return data;
    }, param: function(a) {
        var s = []; if (a.constructor == Array || a.jquery)
            jQuery.each(a, function() { s.push(encodeURIComponent(this.name) + "=" + encodeURIComponent(this.value)); }); else
            for (var j in a)
            if (a[j] && a[j].constructor == Array)
            jQuery.each(a[j], function() { s.push(encodeURIComponent(j) + "=" + encodeURIComponent(this)); }); else
            s.push(encodeURIComponent(j) + "=" + encodeURIComponent(a[j])); return s.join("&").replace(/%20/g, "+");
    } 
    }); jQuery.fn.extend({ show: function(speed, callback) {
        return speed ? this.animate({ height: "show", width: "show", opacity: "show" }, speed, callback) : this.filter(":hidden").each(function() {
            this.style.display = this.oldblock ? this.oldblock : ""; if (jQuery.css(this, "display") == "none")
                this.style.display = "block";
        }).end();
    }, hide: function(speed, callback) {
        return speed ? this.animate({ height: "hide", width: "hide", opacity: "hide" }, speed, callback) : this.filter(":visible").each(function() {
            this.oldblock = this.oldblock || jQuery.css(this, "display"); if (this.oldblock == "none")
                this.oldblock = "block"; this.style.display = "none";
        }).end();
    }, _toggle: jQuery.fn.toggle, toggle: function(fn, fn2) { return jQuery.isFunction(fn) && jQuery.isFunction(fn2) ? this._toggle(fn, fn2) : fn ? this.animate({ height: "toggle", width: "toggle", opacity: "toggle" }, fn, fn2) : this.each(function() { jQuery(this)[jQuery(this).is(":hidden") ? "show" : "hide"](); }); }, slideDown: function(speed, callback) { return this.animate({ height: "show" }, speed, callback); }, slideUp: function(speed, callback) { return this.animate({ height: "hide" }, speed, callback); }, slideToggle: function(speed, callback) { return this.animate({ height: "toggle" }, speed, callback); }, fadeIn: function(speed, callback) { return this.animate({ opacity: "show" }, speed, callback); }, fadeOut: function(speed, callback) { return this.animate({ opacity: "hide" }, speed, callback); }, fadeTo: function(speed, to, callback) { return this.animate({ opacity: to }, speed, callback); }, animate: function(prop, speed, easing, callback) {
        var opt = jQuery.speed(speed, easing, callback); return this[opt.queue === false ? "each" : "queue"](function() {
            opt = jQuery.extend({}, opt); var hidden = jQuery(this).is(":hidden"), self = this; for (var p in prop) {
                if (prop[p] == "hide" && hidden || prop[p] == "show" && !hidden)
                    return jQuery.isFunction(opt.complete) && opt.complete.apply(this); if (p == "height" || p == "width") { opt.display = jQuery.css(this, "display"); opt.overflow = this.style.overflow; } 
            }
            if (opt.overflow != null)
                this.style.overflow = "hidden"; opt.curAnim = jQuery.extend({}, prop); jQuery.each(prop, function(name, val) {
                    var e = new jQuery.fx(self, opt, name); if (/toggle|show|hide/.test(val))
                        e[val == "toggle" ? hidden ? "show" : "hide" : val](prop); else {
                        var parts = val.toString().match(/^([+-]=)?([\d+-.]+)(.*)$/), start = e.cur(true) || 0; if (parts) {
                            var end = parseFloat(parts[2]), unit = parts[3] || "px"; if (unit != "px") { self.style[name] = (end || 1) + unit; start = ((end || 1) / e.cur(true)) * start; self.style[name] = start + unit; }
                            if (parts[1])
                                end = ((parts[1] == "-=" ? -1 : 1) * end) + start; e.custom(start, end, unit);
                        } else
                            e.custom(start, val, "");
                    } 
                }); return true;
        });
    }, queue: function(type, fn) {
        if (jQuery.isFunction(type)) { fn = type; type = "fx"; }
        if (!type || (typeof type == "string" && !fn))
            return queue(this[0], type); return this.each(function() {
                if (fn.constructor == Array)
                    queue(this, type, fn); else {
                    queue(this, type).push(fn); if (queue(this, type).length == 1)
                        fn.apply(this);
                } 
            });
    }, stop: function() {
        var timers = jQuery.timers; return this.each(function() {
            for (var i = 0; i < timers.length; i++)
                if (timers[i].elem == this)
                timers.splice(i--, 1);
        }).dequeue();
    } 
    }); var queue = function(elem, type, array) {
        if (!elem)
            return; var q = jQuery.data(elem, type + "queue"); if (!q || array)
            q = jQuery.data(elem, type + "queue", array ? jQuery.makeArray(array) : []); return q;
    }; jQuery.fn.dequeue = function(type) {
        type = type || "fx"; return this.each(function() {
            var q = queue(this, type); q.shift(); if (q.length)
                q[0].apply(this);
        });
    }; jQuery.extend({ speed: function(speed, easing, fn) {
        var opt = speed && speed.constructor == Object ? speed : { complete: fn || !fn && easing || jQuery.isFunction(speed) && speed, duration: speed, easing: fn && easing || easing && easing.constructor != Function && easing }; opt.duration = (opt.duration && opt.duration.constructor == Number ? opt.duration : { slow: 600, fast: 200}[opt.duration]) || 400; opt.old = opt.complete; opt.complete = function() {
            jQuery(this).dequeue(); if (jQuery.isFunction(opt.old))
                opt.old.apply(this);
        }; return opt;
    }, easing: { linear: function(p, n, firstNum, diff) { return firstNum + diff * p; }, swing: function(p, n, firstNum, diff) { return ((-Math.cos(p * Math.PI) / 2) + 0.5) * diff + firstNum; } }, timers: [], fx: function(elem, options, prop) {
        this.options = options; this.elem = elem; this.prop = prop; if (!options.orig)
            options.orig = {};
    } 
    }); jQuery.fx.prototype = { update: function() {
        if (this.options.step)
            this.options.step.apply(this.elem, [this.now, this]); (jQuery.fx.step[this.prop] || jQuery.fx.step._default)(this); if (this.prop == "height" || this.prop == "width")
            this.elem.style.display = "block";
    }, cur: function(force) {
        if (this.elem[this.prop] != null && this.elem.style[this.prop] == null)
            return this.elem[this.prop]; var r = parseFloat(jQuery.curCSS(this.elem, this.prop, force)); return r && r > -10000 ? r : parseFloat(jQuery.css(this.elem, this.prop)) || 0;
    }, custom: function(from, to, unit) {
        this.startTime = (new Date()).getTime(); this.start = from; this.end = to; this.unit = unit || this.unit || "px"; this.now = this.start; this.pos = this.state = 0; this.update(); var self = this; function t() { return self.step(); }
        t.elem = this.elem; jQuery.timers.push(t); if (jQuery.timers.length == 1) {
            var timer = setInterval(function() {
                var timers = jQuery.timers; for (var i = 0; i < timers.length; i++)
                    if (!timers[i]())
                    timers.splice(i--, 1); if (!timers.length)
                    clearInterval(timer);
            }, 13);
        } 
    }, show: function() {
        this.options.orig[this.prop] = jQuery.attr(this.elem.style, this.prop); this.options.show = true; this.custom(0, this.cur()); if (this.prop == "width" || this.prop == "height")
            this.elem.style[this.prop] = "1px"; jQuery(this.elem).show();
    }, hide: function() { this.options.orig[this.prop] = jQuery.attr(this.elem.style, this.prop); this.options.hide = true; this.custom(this.cur(), 0); }, step: function() {
        var t = (new Date()).getTime(); if (t > this.options.duration + this.startTime) {
            this.now = this.end; this.pos = this.state = 1; this.update(); this.options.curAnim[this.prop] = true; var done = true; for (var i in this.options.curAnim)
                if (this.options.curAnim[i] !== true)
                done = false; if (done) {
                if (this.options.display != null) {
                    this.elem.style.overflow = this.options.overflow; this.elem.style.display = this.options.display; if (jQuery.css(this.elem, "display") == "none")
                        this.elem.style.display = "block";
                }
                if (this.options.hide)
                    this.elem.style.display = "none"; if (this.options.hide || this.options.show)
                    for (var p in this.options.curAnim)
                    jQuery.attr(this.elem.style, p, this.options.orig[p]);
            }
            if (done && jQuery.isFunction(this.options.complete))
                this.options.complete.apply(this.elem); return false;
        } else { var n = t - this.startTime; this.state = n / this.options.duration; this.pos = jQuery.easing[this.options.easing || (jQuery.easing.swing ? "swing" : "linear")](this.state, n, 0, 1, this.options.duration); this.now = this.start + ((this.end - this.start) * this.pos); this.update(); }
        return true;
    } 
    }; jQuery.fx.step = { scrollLeft: function(fx) { fx.elem.scrollLeft = fx.now; }, scrollTop: function(fx) { fx.elem.scrollTop = fx.now; }, opacity: function(fx) { jQuery.attr(fx.elem.style, "opacity", fx.now); }, _default: function(fx) { fx.elem.style[fx.prop] = fx.now + fx.unit; } }; jQuery.fn.offset = function() {
        var left = 0, top = 0, elem = this[0], results; if (elem) with (jQuery.browser) {
            var absolute = jQuery.css(elem, "position") == "absolute", parent = elem.parentNode, offsetParent = elem.offsetParent, doc = elem.ownerDocument, safari2 = safari && parseInt(version) < 522; if (elem.getBoundingClientRect) { box = elem.getBoundingClientRect(); add(box.left + Math.max(doc.documentElement.scrollLeft, doc.body.scrollLeft), box.top + Math.max(doc.documentElement.scrollTop, doc.body.scrollTop)); if (msie) { var border = jQuery("html").css("borderWidth"); border = (border == "medium" || jQuery.boxModel && parseInt(version) >= 7) && 2 || border; add(-border, -border); } } else {
                add(elem.offsetLeft, elem.offsetTop); while (offsetParent) {
                    add(offsetParent.offsetLeft, offsetParent.offsetTop); if (mozilla && /^t[d|h]$/i.test(parent.tagName) || !safari2)
                        border(offsetParent); if (safari2 && !absolute && jQuery.css(offsetParent, "position") == "absolute")
                        absolute = true; offsetParent = offsetParent.offsetParent;
                }
                while (parent.tagName && !/^body|html$/i.test(parent.tagName)) {
                    if (!/^inline|table-row.*$/i.test(jQuery.css(parent, "display")))
                        add(-parent.scrollLeft, -parent.scrollTop); if (mozilla && jQuery.css(parent, "overflow") != "visible")
                        border(parent); parent = parent.parentNode;
                }
                if (safari2 && absolute)
                    add(-doc.body.offsetLeft, -doc.body.offsetTop);
            }
            results = { top: top, left: left };
        }
        return results; function border(elem) { add(jQuery.css(elem, "borderLeftWidth"), jQuery.css(elem, "borderTopWidth")); }
        function add(l, t) { left += parseInt(l) || 0; top += parseInt(t) || 0; } 
    };
})(); if (!this.JSON) {
    JSON = function() {
        function f(n) { return n < 10 ? '0' + n : n; }
        Date.prototype.toJSON = function() {
            return this.getUTCFullYear() + '-' +
f(this.getUTCMonth() + 1) + '-' +
f(this.getUTCDate()) + 'T' +
f(this.getUTCHours()) + ':' +
f(this.getUTCMinutes()) + ':' +
f(this.getUTCSeconds()) + 'Z';
        }; var m = { '\b': '\\b', '\t': '\\t', '\n': '\\n', '\f': '\\f', '\r': '\\r', '"': '\\"', '\\': '\\\\' }; function stringify(value, whitelist) {
            var a, i, k, l, r = /["\\\x00-\x1f\x7f-\x9f]/g, v; switch (typeof value) {
                case 'string': return r.test(value) ? '"' + value.replace(r, function(a) {
                    var c = m[a]; if (c) { return c; }
                    c = a.charCodeAt(); return '\\u00' + Math.floor(c / 16).toString(16) +
(c % 16).toString(16);
                }) + '"' : '"' + value + '"'; case 'number': return isFinite(value) ? String(value) : 'null'; case 'boolean': case 'null': return String(value); case 'object': if (!value) { return 'null'; }
                    if (typeof value.toJSON === 'function') { return stringify(value.toJSON()); }
                    a = []; if (typeof value.length === 'number' && !(value.propertyIsEnumerable('length'))) {
                        l = value.length; for (i = 0; i < l; i += 1) { a.push(stringify(value[i], whitelist) || 'null'); }
                        return '[' + a.join(',') + ']';
                    }
                    if (whitelist) { l = whitelist.length; for (i = 0; i < l; i += 1) { k = whitelist[i]; if (typeof k === 'string') { v = stringify(value[k], whitelist); if (v) { a.push(stringify(k) + ':' + v); } } } } else { for (k in value) { if (typeof k === 'string') { v = stringify(value[k], whitelist); if (v) { a.push(stringify(k) + ':' + v); } } } }
                    return '{' + a.join(',') + '}';
            } 
        }
        return { stringify: stringify, parse: function(text, filter) {
            var j; function walk(k, v) {
                var i, n; if (v && typeof v === 'object') { for (i in v) { if (Object.prototype.hasOwnProperty.apply(v, [i])) { n = walk(i, v[i]); if (n !== undefined) { v[i] = n; } } } }
                return filter(k, v);
            }
            if (/^[\],:{}\s]*$/.test(text.replace(/\\./g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(:?[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) { j = eval('(' + text + ')'); return typeof filter === 'function' ? walk('', j) : j; }
            throw new SyntaxError('parseJSON');
        } 
        };
    } ();
}
(function($) {
    $.metaobjects = function(options) {
        options = $.extend({ context: document, clean: true, selector: 'object.metaobject' }, options); function jsValue(value, name) {
            if (name == "regex") { value = escapeRegex(value); } else { value = escapeValue(value); }
            eval('value = ' + value + ";"); return value;
        }
        function escapeValue(value) {
            if (value.match(/^'.*'$/)) { value = value.replace(/'/g, "\\'"); value = value.replace(/^\\\'/, "'"); value = value.replace(/\\\'$/, "'"); }
            return value;
        }
        function escapeRegex(value) {
            if (value.match(/^'.*'$/)) { value = value.replace(/^'/, "/"); value = value.replace(/'$/, "/"); }
            return value;
        }
        return $(options.selector, options.context).each(function() { var settings = { target: this.parentNode }; $('> param[@name=metaparam]', this).each(function() { $.extend(settings, jsValue(this.value)); }); $('> param', this).not('[@name=metaparam]').each(function() { var type = $(this).attr('type'); var name = this.name; var value = jsValue(this.value, name); $(settings.target).each(function() { this[name] = value; }); }); if (options.clean) { $(this).remove(); } });
    } 
})(jQuery); ; (function($) {
    function Datepicker() { this.debug = false; this._nextId = 0; this._inst = []; this._curInst = null; this._disabledInputs = []; this._datepickerShowing = false; this._inDialog = false; this.regional = []; this.regional[''] = { clearText: 'Clear', clearStatus: 'Erase the current date', closeText: 'Close', closeStatus: 'Close without change', prevText: '<Prev', prevStatus: 'Show the previous month', nextText: 'Next>', nextStatus: 'Show the next month', currentText: 'Today', currentStatus: 'Show the current month', monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], monthStatus: 'Show a different month', yearStatus: 'Show a different year', weekHeader: 'Wk', weekStatus: 'Week of the year', dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], dayNamesMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'], dayStatus: 'Set DD as first week day', dateStatus: 'Select DD, M d', dateFormat: 'mm/dd/yy', firstDay: 0, initStatus: 'Select a date', isRTL: false }; this._defaults = { showOn: 'focus', showAnim: 'show', defaultDate: null, appendText: '', buttonText: '...', buttonImage: '', buttonImageOnly: false, closeAtTop: true, mandatory: false, hideIfNoPrevNext: false, changeMonth: true, changeYear: true, yearRange: '-10:+10', changeFirstDay: false, showOtherMonths: false, showWeeks: false, calculateWeek: this.iso8601Week, shortYearCutoff: '+10', showStatus: false, statusForDate: this.dateStatus, minDate: null, maxDate: null, speed: 'normal', beforeShowDay: null, beforeShow: null, onSelect: null, onClose: null, numberOfMonths: 1, stepMonths: 1, rangeSelect: false, rangeSeparator: ' - ' }; $.extend(this._defaults, this.regional['']); this._datepickerDiv = $('<div id="datepicker_div">'); }
    $.extend(Datepicker.prototype, { markerClassName: 'hasDatepicker', log: function() {
        if (this.debug)
            console.log.apply('', arguments);
    }, _register: function(inst) { var id = this._nextId++; this._inst[id] = inst; return id; }, _getInst: function(id) { return this._inst[id] || id; }, setDefaults: function(settings) { extendRemove(this._defaults, settings || {}); return this; }, _attachDatepicker: function(target, settings) {
        var inlineSettings = null; for (attrName in this._defaults) { var attrValue = target.getAttribute('date:' + attrName); if (attrValue) { inlineSettings = inlineSettings || {}; try { inlineSettings[attrName] = eval(attrValue); } catch (err) { inlineSettings[attrName] = attrValue; } } }
        var nodeName = target.nodeName.toLowerCase(); var instSettings = (inlineSettings ? $.extend(settings || {}, inlineSettings || {}) : settings); if (nodeName == 'input') { var inst = (inst && !inlineSettings ? inst : new DatepickerInstance(instSettings, false)); this._connectDatepicker(target, inst); } else if (nodeName == 'div' || nodeName == 'span') { var inst = new DatepickerInstance(instSettings, true); this._inlineDatepicker(target, inst); } 
    }, _destroyDatepicker: function(target) {
        var nodeName = target.nodeName.toLowerCase(); var calId = target._calId; target._calId = null; var $target = $(target); if (nodeName == 'input') {
            $target.siblings('.datepicker_append').replaceWith('').end().siblings('.datepicker_trigger').replaceWith('').end().removeClass(this.markerClassName).unbind('focus', this._showDatepicker).unbind('keydown', this._doKeyDown).unbind('keypress', this._doKeyPress); var wrapper = $target.parents('.datepicker_wrap'); if (wrapper)
                wrapper.replaceWith(wrapper.html());
        } else if (nodeName == 'div' || nodeName == 'span')
            $target.removeClass(this.markerClassName).empty(); if ($('input[_calId=' + calId + ']').length == 0)
            this._inst[calId] = null;
    }, _enableDatepicker: function(target) { target.disabled = false; $(target).siblings('button.datepicker_trigger').each(function() { this.disabled = false; }).end().siblings('img.datepicker_trigger').css({ opacity: '1.0', cursor: '' }); this._disabledInputs = $.map(this._disabledInputs, function(value) { return (value == target ? null : value); }); }, _disableDatepicker: function(target) { target.disabled = true; $(target).siblings('button.datepicker_trigger').each(function() { this.disabled = true; }).end().siblings('img.datepicker_trigger').css({ opacity: '0.5', cursor: 'default' }); this._disabledInputs = $.map($.datepicker._disabledInputs, function(value) { return (value == target ? null : value); }); this._disabledInputs[$.datepicker._disabledInputs.length] = target; }, _isDisabledDatepicker: function(target) {
        if (!target)
            return false; for (var i = 0; i < this._disabledInputs.length; i++) {
            if (this._disabledInputs[i] == target)
                return true;
        }
        return false;
    }, _changeDatepicker: function(target, name, value) {
        var settings = name || {}; if (typeof name == 'string') { settings = {}; settings[name] = value; }
        if (inst = this._getInst(target._calId)) { extendRemove(inst._settings, settings); this._updateDatepicker(inst); } 
    }, _setDateDatepicker: function(target, date, endDate) { if (inst = this._getInst(target._calId)) { inst._setDate(date, endDate); this._updateDatepicker(inst); } }, _getDateDatepicker: function(target) { var inst = this._getInst(target._calId); return (inst ? inst._getDate() : null); }, _doKeyDown: function(e) {
        var inst = $.datepicker._getInst(this._calId); if ($.datepicker._datepickerShowing)
            switch (e.keyCode) { case 9: $.datepicker._hideDatepicker(null, ''); break; case 13: $.datepicker._selectDay(inst, inst._selectedMonth, inst._selectedYear, $('td.datepicker_daysCellOver', inst._datepickerDiv)[0]); return false; break; case 27: $.datepicker._hideDatepicker(null, inst._get('speed')); break; case 33: $.datepicker._adjustDate(inst, (e.ctrlKey ? -1 : -inst._get('stepMonths')), (e.ctrlKey ? 'Y' : 'M')); break; case 34: $.datepicker._adjustDate(inst, (e.ctrlKey ? +1 : +inst._get('stepMonths')), (e.ctrlKey ? 'Y' : 'M')); break; case 35: if (e.ctrlKey) $.datepicker._clearDate(inst); break; case 36: if (e.ctrlKey) $.datepicker._gotoToday(inst); break; case 37: if (e.ctrlKey) $.datepicker._adjustDate(inst, -1, 'D'); break; case 38: if (e.ctrlKey) $.datepicker._adjustDate(inst, -7, 'D'); break; case 39: if (e.ctrlKey) $.datepicker._adjustDate(inst, +1, 'D'); break; case 40: if (e.ctrlKey) $.datepicker._adjustDate(inst, +7, 'D'); break; }
        else if (e.keyCode == 36 && e.ctrlKey)
            $.datepicker._showDatepicker(this);
    }, _doKeyPress: function(e) { var inst = $.datepicker._getInst(this._calId); var chars = $.datepicker._possibleChars(inst._get('dateFormat')); var chr = String.fromCharCode(e.charCode == undefined ? e.keyCode : e.charCode); return e.ctrlKey || (chr < ' ' || !chars || chars.indexOf(chr) > -1); }, _connectDatepicker: function(target, inst) {
        var input = $(target); if (input.is('.' + this.markerClassName))
            return; var appendText = inst._get('appendText'); var isRTL = inst._get('isRTL'); if (appendText) {
            if (isRTL)
                input.before('<span class="datepicker_append">' + appendText); else
                input.after('<span class="datepicker_append">' + appendText);
        }
        var showOn = inst._get('showOn'); if (showOn == 'focus' || showOn == 'both')
            input.focus(this._showDatepicker); if (showOn == 'button' || showOn == 'both') {
            input.wrap('<span id="calDiv" class="datepicker_wrap">'); var buttonText = inst._get('buttonText'); var buttonImage = inst._get('buttonImage'); var trigger = $(inst._get('buttonImageOnly') ? $('<img>').addClass('datepicker_trigger').attr({ src: buttonImage, alt: buttonText, title: buttonText }) : $('<button>').addClass('datepicker_trigger').attr({ type: 'button' }).html(buttonImage != '' ? $('<img>').attr({ src: buttonImage, alt: buttonText, title: buttonText }) : buttonText)); if (isRTL)
                input.before(trigger); else
                input.after(trigger); trigger.click(function() {
                    if ($.datepicker._datepickerShowing && $.datepicker._lastInput == target)
                        $.datepicker._hideDatepicker(); else
                        $.datepicker._showDatepicker(target);
                });
        }
        input.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).bind("setData.datepicker", function(event, key, value) { inst._settings[key] = value; }).bind("getData.datepicker", function(event, key) { return inst._get(key); }); input[0]._calId = inst._id;
    }, _inlineDatepicker: function(target, inst) {
        var input = $(target); if (input.is('.' + this.markerClassName))
            return; input.addClass(this.markerClassName).append(inst._datepickerDiv).bind("setData.datepicker", function(event, key, value) { inst._settings[key] = value; }).bind("getData.datepicker", function(event, key) { return inst._get(key); }); input[0]._calId = inst._id; this._updateDatepicker(inst);
    }, _inlineShow: function(inst) { var numMonths = inst._getNumberOfMonths(); }, _dialogDatepicker: function(input, dateText, onSelect, settings, pos) {
        var inst = this._dialogInst; if (!inst) { inst = this._dialogInst = new DatepickerInstance({}, false); this._dialogInput = $('<input type="text" size="1" style="position: absolute; top: -100px;"/>'); this._dialogInput.keydown(this._doKeyDown); $('body').append(this._dialogInput); this._dialogInput[0]._calId = inst._id; }
        extendRemove(inst._settings, settings || {}); this._dialogInput.val(dateText); this._pos = (pos ? (pos.length ? pos : [pos.pageX, pos.pageY]) : null); if (!this._pos) { var browserWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth; var browserHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft; var scrollY = document.documentElement.scrollTop || document.body.scrollTop; this._pos = [(browserWidth / 2) - 100 + scrollX, (browserHeight / 2) - 150 + scrollY]; }
        this._dialogInput.css('left', this._pos[0] + 'px').css('top', this._pos[1] + 'px'); inst._settings.onSelect = onSelect; this._inDialog = true; this._datepickerDiv.addClass('datepicker_dialog'); this._showDatepicker(this._dialogInput[0]); if ($.blockUI)
            $.blockUI(this._datepickerDiv); return this;
    }, _showDatepicker: function(input) {
        input = input.target || input; if (input.nodeName.toLowerCase() != 'input')
            input = $('input', input.parentNode)[0]; if ($.datepicker._isDisabledDatepicker(input) || $.datepicker._lastInput == input)
            return; var inst = $.datepicker._getInst(input._calId); var beforeShow = inst._get('beforeShow'); extendRemove(inst._settings, (beforeShow ? beforeShow.apply(input, [input, inst]) : {})); $.datepicker._hideDatepicker(null, ''); $.datepicker._lastInput = input; inst._setDateFromField(input); if ($.datepicker._inDialog)
            input.value = ''; if (!$.datepicker._pos) { $.datepicker._pos = $.datepicker._findPos(input); $.datepicker._pos[1] += input.offsetHeight; }
        var isFixed = false; $(input).parents().each(function() { isFixed |= $(this).css('position') == 'fixed'; }); if (isFixed && $.browser.opera) { $.datepicker._pos[0] -= document.documentElement.scrollLeft; $.datepicker._pos[1] -= document.documentElement.scrollTop; }
        inst._datepickerDiv.css('position', ($.datepicker._inDialog && $.blockUI ? 'static' : (isFixed ? 'fixed' : 'absolute'))).css({ left: $.datepicker._pos[0] + 'px', top: $.datepicker._pos[1] + 'px' }); $.datepicker._pos = null; inst._rangeStart = null; $.datepicker._updateDatepicker(inst); if (!inst._inline) {
            var speed = inst._get('speed'); var postProcess = function() { $.datepicker._datepickerShowing = true; $.datepicker._afterShow(inst); }; var showAnim = inst._get('showAnim') || 'show'; inst._datepickerDiv[showAnim](speed, postProcess); if (speed == '')
                postProcess(); var isVisible = $(':visible', $(inst._input[0])).length > 0; if (isVisible) { inst._input[0].focus(); }
            $.datepicker._curInst = inst;
        } 
    }, _updateDatepicker: function(inst) {
        inst._datepickerDiv.empty().append(inst._generateDatepicker()); var numMonths = inst._getNumberOfMonths(); if (numMonths[0] != 1 || numMonths[1] != 1)
            inst._datepickerDiv.addClass('datepicker_multi'); else
            inst._datepickerDiv.removeClass('datepicker_multi'); if (inst._get('isRTL'))
            inst._datepickerDiv.addClass('datepicker_rtl'); else
            inst._datepickerDiv.removeClass('datepicker_rtl'); if (inst._input) { var isVisible = $(':visible', $(inst._input[0])).length > 0; if (isVisible) { inst._input[0].focus(); } } 
    }, _afterShow: function(inst) {
        var numMonths = inst._getNumberOfMonths(); if ($.browser.msie && parseInt($.browser.version) < 7) { $('#datepicker_cover').css({ width: inst._datepickerDiv.width() + 4, height: inst._datepickerDiv.height() + 4 }); }
        var isFixed = inst._datepickerDiv.css('position') == 'fixed'; var pos = inst._input ? $.datepicker._findPos(inst._input[0]) : null; var browserWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth; var browserHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; var scrollX = (isFixed ? 0 : document.documentElement.scrollLeft || document.body.scrollLeft); var scrollY = (isFixed ? 0 : document.documentElement.scrollTop || document.body.scrollTop); if ((inst._datepickerDiv.offset().left + inst._datepickerDiv.width() -
(isFixed && $.browser.msie ? document.documentElement.scrollLeft : 0)) > (browserWidth + scrollX)) {
            inst._datepickerDiv.css('left', Math.max(scrollX, pos[0] + (inst._input ? $(inst._input[0]).width() : null) - inst._datepickerDiv.width() -
(isFixed && $.browser.opera ? document.documentElement.scrollLeft : 0)) + 'px');
        }
        if ((inst._datepickerDiv.offset().top + inst._datepickerDiv.height() -
(isFixed && $.browser.msie ? document.documentElement.scrollTop : 0)) > (browserHeight + scrollY)) {
            inst._datepickerDiv.css('top', Math.max(scrollY, pos[1] - (this._inDialog ? 0 : inst._datepickerDiv.height()) -
(isFixed && $.browser.opera ? document.documentElement.scrollTop : 0)) + 'px');
        } 
    }, _findPos: function(obj) {
        var notTypeHidden = (obj.type != 'hidden'); while (obj && (obj.type == 'hidden' || obj.nodeType != 1)) { obj = obj.nextSibling; }
        var jObj = $(obj); if (notTypeHidden) { jObj.show(); }
        var position = jObj.offset(); if (notTypeHidden) { jObj.hide(); }
        return [position.left, position.top];
    }, _hideDatepicker: function(input, speed) {
        var inst = this._curInst; if (!inst)
            return; var rangeSelect = inst._get('rangeSelect'); if (rangeSelect && this._stayOpen) { this._selectDate(inst, inst._formatDate(inst._currentDay, inst._currentMonth, inst._currentYear)); }
        this._stayOpen = false; if (this._datepickerShowing) {
            speed = (speed != null ? speed : inst._get('speed')); var showAnim = inst._get('showAnim'); inst._datepickerDiv[(showAnim == 'slideDown' ? 'slideUp' : (showAnim == 'fadeIn' ? 'fadeOut' : 'hide'))](speed, function() { $.datepicker._tidyDialog(inst); }); if (speed == '')
                this._tidyDialog(inst); var onClose = inst._get('onClose'); if (onClose) { onClose.apply((inst._input ? inst._input[0] : null), [inst._getDate(), inst]); }
            this._datepickerShowing = false; this._lastInput = null; inst._settings.prompt = null; if (this._inDialog) { this._dialogInput.css({ position: 'absolute', left: '0', top: '-100px' }); if ($.blockUI) { $.unblockUI(); $('body').append(this._datepickerDiv); } }
            this._inDialog = false;
        }
        this._curInst = null;
    }, _tidyDialog: function(inst) { inst._datepickerDiv.removeClass('datepicker_dialog').unbind('.datepicker'); $('.datepicker_prompt', inst._datepickerDiv).remove(); }, _checkExternalClick: function(event) {
        if (!$.datepicker._curInst)
            return; var $target = $(event.target); if (($target.parents("#datepicker_div").length == 0) && ($target.attr('class') != 'datepicker_trigger') && $.datepicker._datepickerShowing && !($.datepicker._inDialog && $.blockUI)) { $.datepicker._hideDatepicker(null, ''); } 
    }, _adjustDate: function(id, offset, period) { var inst = this._getInst(id); inst._adjustDate(offset, period); this._updateDatepicker(inst); }, _gotoToday: function(id) { var date = new Date(); var inst = this._getInst(id); inst._selectedDay = date.getDate(); inst._drawMonth = inst._selectedMonth = date.getMonth(); inst._drawYear = inst._selectedYear = date.getFullYear(); this._adjustDate(inst); }, _selectMonthYear: function(id, select, period) { var inst = this._getInst(id); inst._selectingMonthYear = false; inst[period == 'M' ? '_drawMonth' : '_drawYear'] = select.options[select.selectedIndex].value - 0; this._adjustDate(inst); }, _clickMonthYear: function(id) {
        var inst = this._getInst(id); if (inst._input && inst._selectingMonthYear && !$.browser.msie)
            inst._input[0].focus(); inst._selectingMonthYear = !inst._selectingMonthYear;
    }, _changeFirstDay: function(id, day) { var inst = this._getInst(id); inst._settings.firstDay = day; this._updateDatepicker(inst); }, _selectDay: function(id, month, year, td) {
        if ($(td).is('.datepicker_unselectable'))
            return; var inst = this._getInst(id); var rangeSelect = inst._get('rangeSelect'); if (rangeSelect) {
            if (!this._stayOpen) { $('.datepicker td').removeClass('datepicker_currentDay'); $(td).addClass('datepicker_currentDay'); }
            this._stayOpen = !this._stayOpen;
        }
        inst._selectedDay = inst._currentDay = $('a', td).html(); inst._selectedMonth = inst._currentMonth = month; inst._selectedYear = inst._currentYear = year; this._selectDate(id, inst._formatDate(inst._currentDay, inst._currentMonth, inst._currentYear)); if (this._stayOpen) { inst._endDay = inst._endMonth = inst._endYear = null; inst._rangeStart = new Date(inst._currentYear, inst._currentMonth, inst._currentDay); this._updateDatepicker(inst); }
        else if (rangeSelect) {
            inst._endDay = inst._currentDay; inst._endMonth = inst._currentMonth; inst._endYear = inst._currentYear; inst._selectedDay = inst._currentDay = inst._rangeStart.getDate(); inst._selectedMonth = inst._currentMonth = inst._rangeStart.getMonth(); inst._selectedYear = inst._currentYear = inst._rangeStart.getFullYear(); inst._rangeStart = null; if (inst._inline)
                this._updateDatepicker(inst);
        } 
    }, _clearDate: function(id) {
        var inst = this._getInst(id); if (inst._get('mandatory'))
            return; this._stayOpen = false; inst._endDay = inst._endMonth = inst._endYear = inst._rangeStart = null; this._selectDate(inst, '');
    }, _selectDate: function(id, dateStr) {
        var inst = this._getInst(id); dateStr = (dateStr != null ? dateStr : inst._formatDate()); if (inst._rangeStart)
            dateStr = inst._formatDate(inst._rangeStart) + inst._get('rangeSeparator') + dateStr; if (inst._input)
            inst._input.val(dateStr); var onSelect = inst._get('onSelect'); if (onSelect)
            onSelect.apply((inst._input ? inst._input[0] : null), [dateStr, inst]); else if (inst._input)
            inst._input.trigger('change'); if (inst._inline)
            this._updateDatepicker(inst); else if (!this._stayOpen) {
            this._hideDatepicker(null, inst._get('speed')); this._lastInput = inst._input[0]; if (typeof (inst._input[0]) != 'object')
                inst._input[0].focus(); this._lastInput = null;
        } 
    }, noWeekends: function(date) { var day = date.getDay(); return [(day > 0 && day < 6), '']; }, iso8601Week: function(date) {
        var checkDate = new Date(date.getFullYear(), date.getMonth(), date.getDate(), (date.getTimezoneOffset() / -60)); var firstMon = new Date(checkDate.getFullYear(), 1 - 1, 4); var firstDay = firstMon.getDay() || 7; firstMon.setDate(firstMon.getDate() + 1 - firstDay); if (firstDay < 4 && checkDate < firstMon) { checkDate.setDate(checkDate.getDate() - 3); return $.datepicker.iso8601Week(checkDate); } else if (checkDate > new Date(checkDate.getFullYear(), 12 - 1, 28)) { firstDay = new Date(checkDate.getFullYear() + 1, 1 - 1, 4).getDay() || 7; if (firstDay > 4 && (checkDate.getDay() || 7) < firstDay - 3) { checkDate.setDate(checkDate.getDate() + 3); return $.datepicker.iso8601Week(checkDate); } }
        return Math.floor(((checkDate - firstMon) / 86400000) / 7) + 1;
    }, dateStatus: function(date, inst) { return $.datepicker.formatDate(inst._get('dateStatus'), date, inst._getFormatConfig()); }, parseDate: function(format, value, settings) {
        if (format == null || value == null)
            throw 'Invalid arguments'; value = (typeof value == 'object' ? value.toString() : value + ''); if (value == '')
            return null; var shortYearCutoff = (settings ? settings.shortYearCutoff : null) || this._defaults.shortYearCutoff; var dayNamesShort = (settings ? settings.dayNamesShort : null) || this._defaults.dayNamesShort; var dayNames = (settings ? settings.dayNames : null) || this._defaults.dayNames; var monthNamesShort = (settings ? settings.monthNamesShort : null) || this._defaults.monthNamesShort; var monthNames = (settings ? settings.monthNames : null) || this._defaults.monthNames; var year = -1; var month = -1; var day = -1; var literal = false; var lookAhead = function(match) {
                var matches = (iFormat + 1 < format.length && format.charAt(iFormat + 1) == match); if (matches)
                    iFormat++; return matches;
            }; var getNumber = function(match) {
                lookAhead(match); var size = (match == 'y' ? 4 : 2); var num = 0; while (size > 0 && iValue < value.length && value.charAt(iValue) >= '0' && value.charAt(iValue) <= '9') { num = num * 10 + (value.charAt(iValue++) - 0); size--; }
                if (size == (match == 'y' ? 4 : 2))
                    throw 'Missing number at position ' + iValue; return num;
            }; var getName = function(match, shortNames, longNames) {
                var names = (lookAhead(match) ? longNames : shortNames); var size = 0; for (var j = 0; j < names.length; j++)
                    size = Math.max(size, names[j].length); var name = ''; var iInit = iValue; while (size > 0 && iValue < value.length) {
                    name += value.charAt(iValue++); for (var i = 0; i < names.length; i++)
                        if (name == names[i])
                        return i + 1; size--;
                }
                throw 'Unknown name at position ' + iInit;
            }; var checkLiteral = function() {
                if (value.charAt(iValue) != format.charAt(iFormat))
                    throw 'Unexpected literal at position ' + iValue; iValue++;
            }; var iValue = 0; for (var iFormat = 0; iFormat < format.length; iFormat++) {
            if (literal)
                if (format.charAt(iFormat) == "'" && !lookAhead("'"))
                literal = false; else
                checkLiteral(); else
                switch (format.charAt(iFormat)) {
                case 'd': day = getNumber('d'); break; case 'D': getName('D', dayNamesShort, dayNames); break; case 'm': month = getNumber('m'); break; case 'M': month = getName('M', monthNamesShort, monthNames); break; case 'y': year = getNumber('y'); break; case "'": if (lookAhead("'"))
                        checkLiteral(); else
                        literal = true; break; default: checkLiteral();
            } 
        }
        if (year < 100) {
            year += new Date().getFullYear() - new Date().getFullYear() % 100 +
(year <= shortYearCutoff ? 0 : -100);
        }
        var date = new Date(year, month - 1, day); if (date.getFullYear() != year || date.getMonth() + 1 != month || date.getDate() != day) { throw 'Invalid date'; }
        return date;
    }, formatDate: function(format, date, settings) {
        if (!date)
            return ''; var dayNamesShort = (settings ? settings.dayNamesShort : null) || this._defaults.dayNamesShort; var dayNames = (settings ? settings.dayNames : null) || this._defaults.dayNames; var monthNamesShort = (settings ? settings.monthNamesShort : null) || this._defaults.monthNamesShort; var monthNames = (settings ? settings.monthNames : null) || this._defaults.monthNames; var lookAhead = function(match) {
                var matches = (iFormat + 1 < format.length && format.charAt(iFormat + 1) == match); if (matches)
                    iFormat++; return matches;
            }; var formatNumber = function(match, value) { return (lookAhead(match) && value < 10 ? '0' : '') + value; }; var formatName = function(match, value, shortNames, longNames) { return (lookAhead(match) ? longNames[value] : shortNames[value]); }; var output = ''; var literal = false; if (date) {
            for (var iFormat = 0; iFormat < format.length; iFormat++) {
                if (literal)
                    if (format.charAt(iFormat) == "'" && !lookAhead("'"))
                    literal = false; else
                    output += format.charAt(iFormat); else
                    switch (format.charAt(iFormat)) {
                    case 'd': output += formatNumber('d', date.getDate()); break; case 'D': output += formatName('D', date.getDay(), dayNamesShort, dayNames); break; case 'm': output += formatNumber('m', date.getMonth() + 1); break; case 'M': output += formatName('M', date.getMonth(), monthNamesShort, monthNames); break; case 'y': output += (lookAhead('y') ? date.getFullYear() : (date.getYear() % 100 < 10 ? '0' : '') + date.getYear() % 100); break; case "'": if (lookAhead("'"))
                            output += "'"; else
                            literal = true; break; default: output += format.charAt(iFormat);
                } 
            } 
        }
        return output;
    }, _possibleChars: function(format) {
        var chars = ''; var literal = false; for (var iFormat = 0; iFormat < format.length; iFormat++)
            if (literal)
            if (format.charAt(iFormat) == "'" && !lookAhead("'"))
            literal = false; else
            chars += format.charAt(iFormat); else
            switch (format.charAt(iFormat)) {
            case 'd' || 'm' || 'y': chars += '0123456789'; break; case 'D' || 'M': return null; case "'": if (lookAhead("'"))
                    chars += "'"; else
                    literal = true; break; default: chars += format.charAt(iFormat);
        }
        return chars;
    } 
    }); function DatepickerInstance(settings, inline) {
        this._id = $.datepicker._register(this); this._selectedDay = 0; this._selectedMonth = 0; this._selectedYear = 0; this._drawMonth = 0; this._drawYear = 0; this._input = null; this._inline = inline; this._datepickerDiv = (!inline ? $.datepicker._datepickerDiv : $('<div id="datepicker_div_' + this._id + '" class="datepicker_inline">')); this._settings = extendRemove(settings || {}); if (inline)
            this._setDate(this._getDefaultDate());
    }
    $.extend(DatepickerInstance.prototype, { _get: function(name) { return this._settings[name] || $.datepicker._defaults[name]; }, _setDateFromField: function(input) {
        this._input = $(input); var dateFormat = this._get('dateFormat'); var dates = this._input ? this._input.val().split(this._get('rangeSeparator')) : null; this._endDay = this._endMonth = this._endYear = null; var date = defaultDate = this._getDefaultDate(); if (dates.length > 0) {
            var settings = this._getFormatConfig(); if (dates.length > 1) { date = $.datepicker.parseDate(dateFormat, dates[1], settings) || defaultDate; this._endDay = date.getDate(); this._endMonth = date.getMonth(); this._endYear = date.getFullYear(); }
            try { date = $.datepicker.parseDate(dateFormat, dates[0], settings) || defaultDate; } catch (e) { $.datepicker.log(e); date = defaultDate; } 
        }
        this._selectedDay = date.getDate(); this._drawMonth = this._selectedMonth = date.getMonth(); this._drawYear = this._selectedYear = date.getFullYear(); this._currentDay = (dates[0] ? date.getDate() : 0); this._currentMonth = (dates[0] ? date.getMonth() : 0); this._currentYear = (dates[0] ? date.getFullYear() : 0); this._adjustDate();
    }, _getDefaultDate: function() { var date = this._determineDate('defaultDate', new Date()); var minDate = this._getMinMaxDate('min', true); var maxDate = this._getMinMaxDate('max'); date = (minDate && date < minDate ? minDate : date); date = (maxDate && date > maxDate ? maxDate : date); return date; }, _determineDate: function(name, defaultDate) {
        var offsetNumeric = function(offset) { var date = new Date(); date.setDate(date.getDate() + offset); return date; }; var offsetString = function(offset, getDaysInMonth) {
            var date = new Date(); var matches = /^([+-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?$/.exec(offset); if (matches) {
                var year = date.getFullYear(); var month = date.getMonth(); var day = date.getDate(); switch (matches[2] || 'd') { case 'd': case 'D': day += (matches[1] - 0); break; case 'w': case 'W': day += (matches[1] * 7); break; case 'm': case 'M': month += (matches[1] - 0); day = Math.min(day, getDaysInMonth(year, month)); break; case 'y': case 'Y': year += (matches[1] - 0); day = Math.min(day, getDaysInMonth(year, month)); break; }
                date = new Date(year, month, day);
            }
            return date;
        }; var date = this._get(name); return (date == null ? defaultDate : (typeof date == 'string' ? offsetString(date, this._getDaysInMonth) : (typeof date == 'number' ? offsetNumeric(date) : date)));
    }, _setDate: function(date, endDate) {
        this._selectedDay = this._currentDay = date.getDate(); this._drawMonth = this._selectedMonth = this._currentMonth = date.getMonth(); this._drawYear = this._selectedYear = this._currentYear = date.getFullYear(); if (this._get('rangeSelect')) { if (endDate) { this._endDay = endDate.getDate(); this._endMonth = endDate.getMonth(); this._endYear = endDate.getFullYear(); } else { this._endDay = this._currentDay; this._endMonth = this._currentMonth; this._endYear = this._currentYear; } }
        this._adjustDate();
    }, _getDate: function() {
        var startDate = (!this._currentYear || (this._input && this._input.val() == '') ? null : new Date(this._currentYear, this._currentMonth, this._currentDay)); if (this._get('rangeSelect')) { return [startDate, (!this._endYear ? null : new Date(this._endYear, this._endMonth, this._endDay))]; } else
            return startDate;
    }, _generateDatepicker: function() {
        var today = new Date(); today = new Date(today.getFullYear(), today.getMonth(), today.getDate()); var showStatus = this._get('showStatus'); var isRTL = this._get('isRTL'); var clear = (this._get('mandatory') ? '' : '<div class="datepicker_clear"><a onclick="jQuery.datepicker._clearDate(' + this._id + ');"' +
(showStatus ? this._addStatus(this._get('clearStatus') || ' ') : '') + '>' +
this._get('clearText') + '</a></div>'); var controls = '<div class="datepicker_control">' + (isRTL ? '' : clear) + '<div class="datepicker_close"><a onclick="jQuery.datepicker._hideDatepicker();"' +
(showStatus ? this._addStatus(this._get('closeStatus') || ' ') : '') + '>' +
this._get('closeText') + '</a></div>' + (isRTL ? clear : '') + '</div>'; var prompt = this._get('prompt'); var closeAtTop = this._get('closeAtTop'); var hideIfNoPrevNext = this._get('hideIfNoPrevNext'); var numMonths = this._getNumberOfMonths(); var stepMonths = this._get('stepMonths'); var isMultiMonth = (numMonths[0] != 1 || numMonths[1] != 1); var minDate = this._getMinMaxDate('min', true); var maxDate = this._getMinMaxDate('max'); var drawMonth = this._drawMonth; var drawYear = this._drawYear; if (maxDate) { var maxDraw = new Date(maxDate.getFullYear(), maxDate.getMonth() - numMonths[1] + 1, maxDate.getDate()); maxDraw = (minDate && maxDraw < minDate ? minDate : maxDraw); while (new Date(drawYear, drawMonth, 1) > maxDraw) { drawMonth--; if (drawMonth < 0) { drawMonth = 11; drawYear--; } } }
        var prev = '<div class="datepicker_prev">' + (this._canAdjustMonth(-1, drawYear, drawMonth) ? '<a onclick="jQuery.datepicker._adjustDate(' + this._id + ', -' + stepMonths + ', \'M\');"' +
(showStatus ? this._addStatus(this._get('prevStatus') || ' ') : '') + '>' +
this._get('prevText') + '</a>' : (hideIfNoPrevNext ? '' : '<label>' + this._get('prevText') + '</label>')) + '</div>'; var next = '<div class="datepicker_next">' + (this._canAdjustMonth(+1, drawYear, drawMonth) ? '<a onclick="jQuery.datepicker._adjustDate(' + this._id + ', +' + stepMonths + ', \'M\');"' +
(showStatus ? this._addStatus(this._get('nextStatus') || ' ') : '') + '>' +
this._get('nextText') + '</a>' : (hideIfNoPrevNext ? '>' : '<label>' + this._get('nextText') + '</label>')) + '</div>'; var html = (prompt ? '<div class="datepicker_prompt">' + prompt + '</div>' : '') +
(closeAtTop && !this._inline ? controls : '') + '<div class="datepicker_links">' + (isRTL ? next : prev) +
(this._isInRange(today) ? '<div class="datepicker_current">' + '<a onclick="jQuery.datepicker._gotoToday(' + this._id + ');"' +
(showStatus ? this._addStatus(this._get('currentStatus') || ' ') : '') + '>' +
this._get('currentText') + '</a></div>' : '') + (isRTL ? prev : next) + '</div>'; var showWeeks = this._get('showWeeks'); for (var row = 0; row < numMonths[0]; row++)
            for (var col = 0; col < numMonths[1]; col++) {
            var selectedDate = new Date(drawYear, drawMonth, this._selectedDay); html += '<div class="datepicker_oneMonth' + (col == 0 ? ' datepicker_newRow' : '') + '">' +
this._generateMonthYearHeader(drawMonth, drawYear, minDate, maxDate, selectedDate, row > 0 || col > 0) + '<table class="datepicker" cellpadding="0" cellspacing="0"><thead>' + '<tr class="datepicker_titleRow">' +
(showWeeks ? '<td>' + this._get('weekHeader') + '</td>' : ''); var firstDay = this._get('firstDay'); var changeFirstDay = this._get('changeFirstDay'); var dayNames = this._get('dayNames'); var dayNamesShort = this._get('dayNamesShort'); var dayNamesMin = this._get('dayNamesMin'); for (var dow = 0; dow < 7; dow++) {
                var day = (dow + firstDay) % 7; var status = this._get('dayStatus') || ' '; status = (status.indexOf('DD') > -1 ? status.replace(/DD/, dayNames[day]) : status.replace(/D/, dayNamesShort[day])); html += '<td' + ((dow + firstDay + 6) % 7 >= 5 ? ' class="datepicker_weekEndCell"' : '') + '>' +
(!changeFirstDay ? '<span' : '<a onclick="jQuery.datepicker._changeFirstDay(' + this._id + ', ' + day + ');"') +
(showStatus ? this._addStatus(status) : '') + ' title="' + dayNames[day] + '">' +
dayNamesMin[day] + (changeFirstDay ? '</a>' : '</span>') + '</td>';
            }
            html += '</tr></thead><tbody>'; var daysInMonth = this._getDaysInMonth(drawYear, drawMonth); if (drawYear == this._selectedYear && drawMonth == this._selectedMonth) { this._selectedDay = Math.min(this._selectedDay, daysInMonth); }
            var leadDays = (this._getFirstDayOfMonth(drawYear, drawMonth) - firstDay + 7) % 7; var currentDate = (!this._currentDay ? new Date(9999, 9, 9) : new Date(this._currentYear, this._currentMonth, this._currentDay)); var endDate = this._endDay ? new Date(this._endYear, this._endMonth, this._endDay) : currentDate; var printDate = new Date(drawYear, drawMonth, 1 - leadDays); var numRows = (isMultiMonth ? 6 : Math.ceil((leadDays + daysInMonth) / 7)); var beforeShowDay = this._get('beforeShowDay'); var showOtherMonths = this._get('showOtherMonths'); var calculateWeek = this._get('calculateWeek') || $.datepicker.iso8601Week; var dateStatus = this._get('statusForDate') || $.datepicker.dateStatus; for (var dRow = 0; dRow < numRows; dRow++) {
                html += '<tr class="datepicker_daysRow">' +
(showWeeks ? '<td class="datepicker_weekCol">' + calculateWeek(printDate) + '</td>' : ''); for (var dow = 0; dow < 7; dow++) {
                    var daySettings = (beforeShowDay ? beforeShowDay.apply((this._input ? this._input[0] : null), [printDate]) : [true, '']); var otherMonth = (printDate.getMonth() != drawMonth); var unselectable = otherMonth || !daySettings[0] || (minDate && printDate < minDate) || (maxDate && printDate > maxDate); html += '<td class="datepicker_daysCell' +
((dow + firstDay + 6) % 7 >= 5 ? ' datepicker_weekEndCell' : '') +
(otherMonth ? ' datepicker_otherMonth' : '') +
(printDate.getTime() == selectedDate.getTime() && drawMonth == this._selectedMonth ? ' datepicker_daysCellOver' : '') +
(unselectable ? ' datepicker_unselectable' : '') +
(otherMonth && !showOtherMonths ? '' : ' ' + daySettings[1] +
(printDate.getTime() >= currentDate.getTime() && printDate.getTime() <= endDate.getTime() ? ' datepicker_currentDay' : '') +
(printDate.getTime() == today.getTime() ? ' datepicker_today' : '')) + '"' +
(unselectable ? '' : ' onmouseover="jQuery(this).addClass(\'datepicker_daysCellOver\');' +
(!showStatus || (otherMonth && !showOtherMonths) ? '' : 'jQuery(\'#datepicker_status_' +
this._id + '\').html(\'' + (dateStatus.apply((this._input ? this._input[0] : null), [printDate, this]) || ' ') + '\');') + '"' + ' onmouseout="jQuery(this).removeClass(\'datepicker_daysCellOver\');' +
(!showStatus || (otherMonth && !showOtherMonths) ? '' : 'jQuery(\'#datepicker_status_' +
this._id + '\').html(\' \');') + '" onclick="jQuery.datepicker._selectDay(' +
this._id + ',' + drawMonth + ',' + drawYear + ', this);"') + '>' +
(otherMonth ? (showOtherMonths ? printDate.getDate() : ' ') : (unselectable ? printDate.getDate() : '<a>' + printDate.getDate() + '</a>')) + '</td>'; printDate.setDate(printDate.getDate() + 1);
                }
                html += '</tr>';
            }
            drawMonth++; if (drawMonth > 11) { drawMonth = 0; drawYear++; }
            html += '</tbody></table></div>';
        }
        html += (showStatus ? '<div id="datepicker_status_' + this._id + '" class="datepicker_status">' + (this._get('initStatus') || ' ') + '</div>' : '') +
(!closeAtTop && !this._inline ? controls : '') + '<div style="clear: both;"></div>' +
($.browser.msie && parseInt($.browser.version) < 7 && !this._inline ? '<iframe src="javascript:false;" class="datepicker_cover"></iframe>' : ''); return html;
    }, _generateMonthYearHeader: function(drawMonth, drawYear, minDate, maxDate, selectedDate, secondary) {
        minDate = (this._rangeStart && minDate && selectedDate < minDate ? selectedDate : minDate); var showStatus = this._get('showStatus'); var html = '<div class="datepicker_header">'; var monthNames = this._get('monthNames'); if (secondary || !this._get('changeMonth'))
            html += monthNames[drawMonth] + ' '; else {
            var inMinYear = (minDate && minDate.getFullYear() == drawYear); var inMaxYear = (maxDate && maxDate.getFullYear() == drawYear); html += '<select class="datepicker_newMonth" ' + 'onchange="jQuery.datepicker._selectMonthYear(' + this._id + ', this, \'M\');" ' + 'onclick="jQuery.datepicker._clickMonthYear(' + this._id + ');"' +
(showStatus ? this._addStatus(this._get('monthStatus') || ' ') : '') + '>'; for (var month = 0; month < 12; month++) {
                if ((!inMinYear || month >= minDate.getMonth()) && (!inMaxYear || month <= maxDate.getMonth())) {
                    html += '<option value="' + month + '"' +
(month == drawMonth ? ' selected="selected"' : '') + '>' + monthNames[month] + '</option>';
                } 
            }
            html += '</select>';
        }
        if (secondary || !this._get('changeYear'))
            html += drawYear; else {
            var years = this._get('yearRange').split(':'); var year = 0; var endYear = 0; if (years.length != 2) { year = drawYear - 10; endYear = drawYear + 10; } else if (years[0].charAt(0) == '+' || years[0].charAt(0) == '-') { year = drawYear + parseInt(years[0], 10); endYear = drawYear + parseInt(years[1], 10); } else { year = parseInt(years[0], 10); endYear = parseInt(years[1], 10); }
            year = (minDate ? Math.max(year, minDate.getFullYear()) : year); endYear = (maxDate ? Math.min(endYear, maxDate.getFullYear()) : endYear); html += '<select class="datepicker_newYear" ' + 'onchange="jQuery.datepicker._selectMonthYear(' + this._id + ', this, \'Y\');" ' + 'onclick="jQuery.datepicker._clickMonthYear(' + this._id + ');"' +
(showStatus ? this._addStatus(this._get('yearStatus') || ' ') : '') + '>'; for (; year <= endYear; year++) {
                html += '<option value="' + year + '"' +
(year == drawYear ? ' selected="selected"' : '') + '>' + year + '</option>';
            }
            html += '</select>';
        }
        html += '</div>'; return html;
    }, _addStatus: function(text) { return ' onmouseover="jQuery(\'#datepicker_status_' + this._id + '\').html(\'' + text + '\');" ' + 'onmouseout="jQuery(\'#datepicker_status_' + this._id + '\').html(\' \');"'; }, _adjustDate: function(offset, period) {
        var year = this._drawYear + (period == 'Y' ? offset : 0); var month = this._drawMonth + (period == 'M' ? offset : 0); var day = Math.min(this._selectedDay, this._getDaysInMonth(year, month)) +
(period == 'D' ? offset : 0); var date = new Date(year, month, day); var minDate = this._getMinMaxDate('min', true); var maxDate = this._getMinMaxDate('max'); date = (minDate && date < minDate ? minDate : date); date = (maxDate && date > maxDate ? maxDate : date); this._selectedDay = date.getDate(); this._drawMonth = this._selectedMonth = date.getMonth(); this._drawYear = this._selectedYear = date.getFullYear();
    }, _getNumberOfMonths: function() { var numMonths = this._get('numberOfMonths'); return (numMonths == null ? [1, 1] : (typeof numMonths == 'number' ? [1, numMonths] : numMonths)); }, _getMinMaxDate: function(minMax, checkRange) {
        var date = this._determineDate(minMax + 'Date', null); if (date) { date.setHours(0); date.setMinutes(0); date.setSeconds(0); date.setMilliseconds(0); }
        return date || (checkRange ? this._rangeStart : null);
    }, _getDaysInMonth: function(year, month) { return 32 - new Date(year, month, 32).getDate(); }, _getFirstDayOfMonth: function(year, month) { return new Date(year, month, 1).getDay(); }, _canAdjustMonth: function(offset, curYear, curMonth) {
        var numMonths = this._getNumberOfMonths(); var date = new Date(curYear, curMonth + (offset < 0 ? offset : numMonths[1]), 1); if (offset < 0)
            date.setDate(this._getDaysInMonth(date.getFullYear(), date.getMonth())); return this._isInRange(date);
    }, _isInRange: function(date) { var newMinDate = (!this._rangeStart ? null : new Date(this._selectedYear, this._selectedMonth, this._selectedDay)); newMinDate = (newMinDate && this._rangeStart < newMinDate ? this._rangeStart : newMinDate); var minDate = newMinDate || this._getMinMaxDate('min'); var maxDate = this._getMinMaxDate('max'); return ((!minDate || date >= minDate) && (!maxDate || date <= maxDate)); }, _getFormatConfig: function() { var shortYearCutoff = this._get('shortYearCutoff'); shortYearCutoff = (typeof shortYearCutoff != 'string' ? shortYearCutoff : new Date().getFullYear() % 100 + parseInt(shortYearCutoff, 10)); return { shortYearCutoff: shortYearCutoff, dayNamesShort: this._get('dayNamesShort'), dayNames: this._get('dayNames'), monthNamesShort: this._get('monthNamesShort'), monthNames: this._get('monthNames') }; }, _formatDate: function(day, month, year) {
        if (!day) { this._currentDay = this._selectedDay; this._currentMonth = this._selectedMonth; this._currentYear = this._selectedYear; }
        var date = (day ? (typeof day == 'object' ? day : new Date(year, month, day)) : new Date(this._currentYear, this._currentMonth, this._currentDay)); return $.datepicker.formatDate(this._get('dateFormat'), date, this._getFormatConfig());
    } 
    }); function extendRemove(target, props) {
        $.extend(target, props); for (var name in props)
            if (props[name] == null)
            target[name] = null; return target;
    }; $.fn.datepicker = function(options) {
        var otherArgs = Array.prototype.slice.call(arguments, 1); if (typeof options == 'string' && (options == 'isDisabled' || options == 'getDate')) { return $.datepicker['_' + options + 'Datepicker'].apply($.datepicker, [this[0]].concat(otherArgs)); }
        return this.each(function() { typeof options == 'string' ? $.datepicker['_' + options + 'Datepicker'].apply($.datepicker, [this].concat(otherArgs)) : $.datepicker._attachDatepicker(this, options); });
    }; $(document).ready(function() { $(".section h5").click(function() { var a = $(this).parent("div"); if (a.hasClass("expanded")) { a.children("p").hide(); a.removeClass("expanded"); a.addClass("contracted") } else { if (a.hasClass("contracted")) { a.children("p").show(); a.removeClass("contracted"); a.addClass("expanded") } } }); $(".remindermainpromo a").click(function() { var c = $(this).attr("class"), b = $("ul.remindercarousel li:visible"), a = $("ul.remindercarousel li").length - 1; b.hide(); if (c == "back") { if (b.prev().length != 0) { b.prev().show() } else { $("ul.remindercarousel li").eq(a).show() } } else { if (c == "next") { if (b.next().length != 0) { b.next().show() } else { $("ul.remindercarousel li").eq(0).show() } } } }); $(".titlebar").click(function() { var a = $(this).parent("fieldset"); if (a.hasClass("expanded")) { a.addClass("collapsed"); a.removeClass("expanded") } else { if (a.hasClass("collapsed")) { a.removeClass("collapsed"); a.addClass("expanded") } } }); $(".sidebar h4.collapsible").click(function() { var a = $(this).text(); if ($(this).hasClass("expanded")) { $(this).next("div").addClass("hidden"); $(this).addClass("collapsed"); $(this).removeClass("expanded"); $(this).text(a.replace(/Hide/i, "Show")); } else { if ($(this).hasClass("collapsed")) { $(this).next("div").removeClass("hidden"); $(this).addClass("expanded"); $(this).removeClass("collapsed"); $(this).text(a.replace(/Show/i, "Hide")); } } }); $(document.body).append($.datepicker._datepickerDiv).mousedown($.datepicker._checkExternalClick); }); $.datepicker = new Datepicker();
})(jQuery); SKYSALES = {}; SKYSALES.Json = window.JSON; SKYSALES.Resource = {}; SKYSALES.Util = {}; SKYSALES.Class = {}; SKYSALES.Instance = {}; SKYSALES.Instance.index = 0; SKYSALES.Instance.getNextIndex = function() { SKYSALES.Instance.index += 1; return SKYSALES.Instance.index; }; if (!SKYSALES.Class.LocaleCurrency) {
    SKYSALES.Class.LocaleCurrency = function() {
        var parent = new SKYSALES.Class.SkySales(); var thisLocaleCurrency = SKYSALES.Util.extendObject(parent); thisLocaleCurrency.num = null; thisLocaleCurrency.localeCurrency = null; var resource = SKYSALES.Util.getResource(); var currencyCultureInfo = resource.currencyCultureInfo; var integerPartNum = 0; var integerPartString = ''; var decimalPartString = ''; var number = ''; var positive = true; var getCurrencyPattern = function() {
            var pattern = currencyCultureInfo.positivePattern; if (!positive) { pattern = currencyCultureInfo.negativePattern; }
            return pattern;
        }; var getIntegerPart = function(numVal) {
            var groupSizes = currencyCultureInfo.groupSizes || []; var groupSeparator = currencyCultureInfo.groupSeparator; var groupSizesIndex = 0; var index = 0; var currentGroupSize = 3; if (groupSizesIndex > groupSizes.length) { currentGroupSize = groupSizes[groupSizesIndex]; }
            var currentGroupEndIndex = currentGroupSize - 1; integerPartNum = Math.floor(numVal); var localString = integerPartNum.toString(); var array = localString.split(''); var reverseArray = array.reverse(); var reverseArrayOutput = []; var getNextGroupSize = function() {
                var nextGroupSize = 3; if (groupSizesIndex <= groupSizes.length - 2) { groupSizesIndex += 1; nextGroupSize = groupSizes[groupSizesIndex]; }
                else { nextGroupSize = currentGroupSize; }
                currentGroupEndIndex += nextGroupSize; return nextGroupSize;
            }; for (index = 0; index < reverseArray.length; index += 1) {
                if (index > currentGroupEndIndex) { currentGroupSize = getNextGroupSize(); reverseArrayOutput.push(groupSeparator); }
                reverseArrayOutput.push(reverseArray[index]);
            }
            array = reverseArrayOutput.reverse(); var outputString = array.join(''); return outputString;
        }; var getDecimalPart = function(numVal) { var decimalPart = numVal - integerPartNum; var decimalPartTrimmed = decimalPart.toFixed(currencyCultureInfo.decimalDigits); var decimalPartString = decimalPartTrimmed.substring(2); return decimalPartString; }; var applyPattern = function() { var pattern = getCurrencyPattern() || ''; var replaceNumber = pattern.replace('n', number); return replaceNumber; }; var invariantNumberToLocaleCurrency = function() { thisLocaleCurrency.currency = thisLocaleCurrency.num.toString(); positive = thisLocaleCurrency.num >= 0; thisLocaleCurrency.num = Math.abs(thisLocaleCurrency.num); integerPartString = getIntegerPart(thisLocaleCurrency.num); decimalPartString = getDecimalPart(thisLocaleCurrency.num); number = integerPartString + currencyCultureInfo.decimalSeparator + decimalPartString; thisLocaleCurrency.currency = applyPattern(); }; thisLocaleCurrency.init = function(json) { this.setSettingsByObject(json); if (null !== this.num) { invariantNumberToLocaleCurrency(); } }; return thisLocaleCurrency;
    };
}
SKYSALES.Class.Resource = function() {
    var parent = new SKYSALES.Class.SkySales(); var thisResource = SKYSALES.Util.extendObject(parent); thisResource.locationInfo = {}; thisResource.countryInfo = {}; thisResource.stationInfo = {}; thisResource.macInfo = {}; thisResource.marketInfo = {}; thisResource.macHash = {}; thisResource.stationHash = {}; thisResource.marketHash = {}; thisResource.sourceInfo = {}; thisResource.clientHash = {}; thisResource.dateCultureInfo = {}; thisResource.currencyCultureInfo = {}; thisResource.populateMacHash = function() {
        var i = 0; var macArray = []; var macHash = {}; var mac = null; if (thisResource.macInfo && thisResource.macInfo.MacList) { macArray = thisResource.macInfo.MacList; for (i = 0; i < macArray.length; i += 1) { mac = macArray[i]; macHash[mac.code] = mac; } }
        thisResource.macHash = macHash;
    }; thisResource.populateStationHash = function() {
        var i = 0; var stationArray = []; var stationHash = {}; var station = null; if (thisResource.stationInfo && thisResource.stationInfo.StationList) { stationArray = thisResource.stationInfo.StationList; for (i = 0; i < stationArray.length; i += 1) { station = stationArray[i]; stationHash[station.code] = station; } }
        thisResource.stationHash = stationHash;
    }; thisResource.populateMarketHash = function() {
        var i = 0; var marketHash = {}; var marketArray = []; var market = {}; var destinationIndex = 0; var destinationArray = []; var destinationCode = ''; var destination = {}; var station = {}; if (thisResource.marketInfo && thisResource.marketInfo.MarketList) {
            marketArray = thisResource.marketInfo.MarketList; for (i = 0; i < marketArray.length; i += 1) { market = marketArray[i]; destinationArray = market.Value; if (destinationArray) { marketHash[market.Key] = destinationArray; for (destinationIndex = 0; destinationIndex < destinationArray.length; destinationIndex += 1) { destination = destinationArray[destinationIndex]; destinationCode = destination.code; destination.name = ''; destination.countryCode = ''; station = thisResource.stationHash[destinationCode]; if (station) { destination.name = station.name; destination.countryCode = station.countryCode; } } } }
            thisResource.marketHash = marketHash;
        } 
    }; thisResource.populateClientHash = function() { var cookie = window.document.cookie; var nameValueArray = []; var i = 0; var singleNameValue = ''; var key = ''; var value = ''; var eqIndex = -1; if (cookie) { nameValueArray = document.cookie.split('; '); for (i = 0; i < nameValueArray.length; i += 1) { singleNameValue = nameValueArray[i]; eqIndex = singleNameValue.indexOf('='); if (eqIndex > -1) { key = singleNameValue.substring(0, eqIndex); value = singleNameValue.substring(eqIndex + 1, singleNameValue.length); if (key) { value = SKYSALES.Util.decodeUriComponent(value); thisResource.clientHash[key] = value; } } } } }; thisResource.setSettingsByObject = function(jsonObject) { parent.setSettingsByObject.call(this, jsonObject); thisResource.populateStationHash(); thisResource.populateMacHash(); thisResource.populateMarketHash(); thisResource.populateClientHash(); }; return thisResource;
}; SKYSALES.Util.createObjectArray = []; SKYSALES.Util.createObject = function(objNameBase, objType, json) { var createObjectArray = SKYSALES.Util.createObjectArray; createObjectArray[createObjectArray.length] = { 'objNameBase': objNameBase, 'objType': objType, 'json': json }; }; SKYSALES.Util.initObjects = function() {
    var i = 0; var createObjectArray = SKYSALES.Util.createObjectArray; var objName = ''; var objectType = ''; var json = null; var createObject = null; for (i = 0; i < createObjectArray.length; i += 1) { createObject = createObjectArray[i]; objName = createObject.objNameBase + SKYSALES.Instance.getNextIndex(); objectType = createObject.objType; json = createObject.json || {}; if (SKYSALES.Class[objectType]) { SKYSALES.Instance[objName] = new SKYSALES.Class[objectType](); SKYSALES.Instance[objName].init(json); } }
    SKYSALES.Util.createObjectArray = [];
}; SKYSALES.Util.decodeUriComponent = function(str) {
    str = str || ''; if (window.decodeURIComponent) { str = window.decodeURIComponent(str); }
    str = str.replace(/\+/g, ' '); return str;
}; SKYSALES.Util.encodeUriComponent = function(str) {
    str = str || ''; if (window.encodeURIComponent) { str = window.encodeURIComponent(str); }
    return str;
}; SKYSALES.Util.getResource = function() { return SKYSALES.Resource; }; SKYSALES.Util.extendObject = function(o) { var F = function() { }; F.prototype = o; return new F(); }; SKYSALES.Util.initializeNewObject = function(paramObject) {
    var objName = ""; var defaultSetting = { objNameBase: '', objType: '', selector: '' }; var validateParamObject = function() {
        var retVal = true; $().extend(defaultSetting, paramObject); var propName = null; for (propName in defaultSetting) { if (defaultSetting.hasOwnProperty(propName)) { if (defaultSetting[propName] === undefined) { retVal = false; break; } } }
        return retVal;
    }; var paramNodeFunction = function(index) {
        var paramNodeValue = $(this).val(); var parsedJsonObject = SKYSALES.Json.parse(paramNodeValue); var funRef = null; var refName = ''; var refArray = []; var i = 0; var refIndex = 0; var arrayRegex = /^([a-zA-Z0-9]+)\[(\d+)\]$/; var matchArray = []; if (parsedJsonObject.method !== undefined) {
            funRef = SKYSALES.Instance[objName]; if (parsedJsonObject.method.name.indexOf('.') > -1) {
                refArray = parsedJsonObject.method.name.split('.'); for (i = 0; i < refArray.length; i += 1) {
                    refName = refArray[i]; matchArray = refName.match(arrayRegex); if ((matchArray) && (matchArray.length > 0)) { refName = matchArray[1]; refIndex = matchArray[2]; refIndex = parseInt(refIndex, 10); funRef = funRef[refName][refIndex]; }
                    else { funRef = funRef[refName]; } 
                } 
            }
            else { funRef = funRef[parsedJsonObject.method.name]; }
            if (funRef) { funRef(parsedJsonObject.method.paramJsonObject); } 
        } 
    }; var objectNodeFunction = function() {
        objName = paramObject.objNameBase + SKYSALES.Instance.getNextIndex(); if (SKYSALES.Class[paramObject.objType]) { SKYSALES.Instance[objName] = new SKYSALES.Class[paramObject.objType](); $("object.jsObject > param", this).each(paramNodeFunction); }
        else { alert("Object Type Not Found: " + paramObject.objType); } 
    }; var containerFunction = function() {
        var isValid = validateParamObject(); if (isValid) { $(paramObject.selector).each(objectNodeFunction); }
        else { alert("\nthere has been an error"); } 
    }; containerFunction(); return false;
}; SKYSALES.Util.populateSelect = function(paramObj) {
    var selectedItem = paramObj.selectedItem || null; var objectArray = paramObj.objectArray || null; var selectBox = paramObj.selectBox || null; var showCode = paramObj.showCode || false; var clearOptions = paramObj.clearOptions || false; var text = ''; var value = ''; var selectBoxObj = null; var obj = null; var prop = ''; if (selectBox) {
        selectBoxObj = selectBox.get(0); if (selectBoxObj && selectBoxObj.options) {
            if (clearOptions) { selectBoxObj.options.length = 0; }
            else {
                if (!selectBoxObj.originalOptionLength) { selectBoxObj.originalOptionLength = selectBoxObj.options.length; }
                selectBoxObj.options.length = selectBoxObj.originalOptionLength;
            }
            if (objectArray) {
                for (prop in objectArray) {
                    if (objectArray.hasOwnProperty(prop)) {
                        obj = objectArray[prop]; if (showCode) { text = obj.name + ' (' + obj.code + ')'; }
                        else { text = obj.name; }
                        value = obj.code; selectBoxObj.options[selectBoxObj.options.length] = new window.Option(text, value, false, false);
                    } 
                }
                if (selectedItem !== null) { selectBox.val(selectedItem); } 
            } 
        } 
    } 
}; SKYSALES.Util.cloneArray = function(array) { return array.concat(); }; SKYSALES.Util.convertToLocaleCurrency = function(num) { var json = { 'num': num }; var localeCurrency = new SKYSALES.Class.LocaleCurrency(); localeCurrency.init(json); return localeCurrency.currency; }; if (!SKYSALES.Class.SkySales) { SKYSALES.Class.SkySales = function() { var thisSkySales = this; thisSkySales.containerId = ''; thisSkySales.container = null; thisSkySales.init = SKYSALES.Class.SkySales.prototype.init; thisSkySales.setSettingsByObject = SKYSALES.Class.SkySales.prototype.setSettingsByObject; thisSkySales.addEvents = SKYSALES.Class.SkySales.prototype.addEvents; thisSkySales.setVars = SKYSALES.Class.SkySales.prototype.setVars; thisSkySales.hide = SKYSALES.Class.SkySales.prototype.hide; thisSkySales.show = SKYSALES.Class.SkySales.prototype.show; return thisSkySales; }; SKYSALES.Class.SkySales.prototype.init = function(json) { this.setSettingsByObject(json); this.setVars(); }; SKYSALES.Class.SkySales.prototype.setSettingsByObject = function(json) { var propName = ''; for (propName in json) { if (json.hasOwnProperty(propName)) { if (this[propName] !== undefined) { this[propName] = json[propName]; } } } }; SKYSALES.Class.SkySales.prototype.addEvents = function() { }; SKYSALES.Class.SkySales.prototype.setVars = function() { this.container = $('#' + this.containerId); }; SKYSALES.Class.SkySales.prototype.hide = function() { this.container.hide('slow'); }; SKYSALES.Class.SkySales.prototype.show = function() { this.container.show('slow'); }; }
if (!SKYSALES.Class.BaseToggleView) {
    SKYSALES.Class.BaseToggleView = function() {
        var parent = SKYSALES.Class.SkySales(); var thisBaseToggleView = SKYSALES.Util.extendObject(parent); thisBaseToggleView.toggleViewIdArray = []; thisBaseToggleView.toggleViewArray = []; thisBaseToggleView.addToggleView = function(json) {
            if (json.toggleViewIdArray) { json = json.toggleViewIdArray; }
            var toggleViewIdArray = json || []; var toggleViewIdObj = null; var i = 0; var toggleView = null; if (toggleViewIdArray.length === undefined) { toggleViewIdArray = []; toggleViewIdArray[0] = json; }
            for (i = 0; i < toggleViewIdArray.length; i += 1) { toggleViewIdObj = toggleViewIdArray[i]; toggleView = new SKYSALES.Class.ToggleView(); toggleView.init(toggleViewIdObj); thisBaseToggleView.toggleViewArray[thisBaseToggleView.toggleViewArray.length] = toggleView; } 
        }; return thisBaseToggleView;
    };
}
if (!SKYSALES.Class.FlightSearch) {
    SKYSALES.Class.FlightSearch = function() {
        var parent = new SKYSALES.Class.SkySales(); var thisFlightSearch = SKYSALES.Util.extendObject(parent); thisFlightSearch.marketArray = null; thisFlightSearch.flightTypeInputIdArray = null; thisFlightSearch.countryInputIdArray = null; var countryInputArray = []; var flightTypeInputArray = []; thisFlightSearch.init = function(paramObject) { this.setSettingsByObject(paramObject); this.setVars(); this.addEvents(); this.initFlightTypeInputIdArray(); this.initCountryInputIdArray(); this.populateFlightType(); }; thisFlightSearch.setSettingsByObject = function(json) { parent.setSettingsByObject.call(this, json); var i = 0; var marketArray = this.marketArray || []; var market = null; for (i = 0; i < marketArray.length; i += 1) { market = new SKYSALES.Class.FlightSearchMarket(); market.flightSearch = this; market.index = i; market.init(marketArray[i]); thisFlightSearch.marketArray[i] = market; } }; thisFlightSearch.initCountryInputIdArray = function() { var i = 0; var countryInputId = null; var countryInput = {}; var countryInputIdArray = this.countryInputIdArray || []; for (i = 0; i < countryInputIdArray.length; i += 1) { countryInputId = countryInputIdArray[i]; countryInput = new SKYSALES.Class.CountryInput(); countryInput.init(countryInputId); countryInputArray[countryInputArray.length] = countryInput; } }; thisFlightSearch.initFlightTypeInputIdArray = function() { var i = 0; var flightTypeInputId = null; var flightTypeInput = {}; var flightTypeInputIdArray = this.flightTypeInputIdArray || []; for (i = 0; i < flightTypeInputIdArray.length; i += 1) { flightTypeInputId = flightTypeInputIdArray[i]; flightTypeInput = new SKYSALES.Class.FlightTypeInput(); flightTypeInput.flightSearch = this; flightTypeInput.index = i; flightTypeInput.init(flightTypeInputId); flightTypeInputArray[flightTypeInputArray.length] = flightTypeInput; } }; thisFlightSearch.populateFlightType = function() { var flightTypeIndex = 0; var flightType = null; for (flightTypeIndex = 0; flightTypeIndex < flightTypeInputArray.length; flightTypeIndex += 1) { flightType = flightTypeInputArray[flightTypeIndex]; if (flightType.input.attr('checked')) { flightType.input.click(); break; } } }; thisFlightSearch.updateFlightType = function(activeflightType) {
            var flightTypeIndex = 0; var flightType = null; for (flightTypeIndex = 0; flightTypeIndex < flightTypeInputArray.length; flightTypeIndex += 1) { flightType = flightTypeInputArray[flightTypeIndex]; flightType.hideInputArray.show(); }
            activeflightType.hideInputArray.hide();
        }; return thisFlightSearch;
    }; SKYSALES.Class.FlightSearch.createObject = function(json) { SKYSALES.Util.createObject('flightSearch', 'FlightSearch', json); };
}
if (!SKYSALES.Class.FlightSearchMarket) { SKYSALES.Class.FlightSearchMarket = function() { var parent = new SKYSALES.Class.SkySales(); var thisFlightSearchMarket = SKYSALES.Util.extendObject(parent); thisFlightSearchMarket.flightSearch = null; thisFlightSearchMarket.index = -1; thisFlightSearchMarket.validationMessageObject = {}; thisFlightSearchMarket.validationObjectIdArray = []; thisFlightSearchMarket.stationInputIdArray = []; thisFlightSearchMarket.stationDropDownIdArray = []; thisFlightSearchMarket.marketInputIdArray = []; thisFlightSearchMarket.macInputIdArray = []; thisFlightSearchMarket.marketDateIdArray = []; var marketInputArray = []; var stationInputArray = []; var stationDropDownArray = []; var macInputArray = []; var marketDateArray = []; thisFlightSearchMarket.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.addEvents(); this.initMarketInputIdArray(); this.initStationInputIdArray(); this.initStationDropDownIdArray(); this.initMacInputIdArray(); this.initMarketDateIdArray(); this.initValidationObjectRedirect(); }; thisFlightSearchMarket.initMacInputIdArray = function() { var i = 0; var macInputId = null; var macInput = {}; var macInputIdArray = this.macInputIdArray || []; for (i = 0; i < macInputIdArray.length; i += 1) { macInputId = macInputIdArray[i]; macInput = new SKYSALES.Class.MacInput(); macInput.init(macInputId); macInputArray[macInputArray.length] = macInput; macInput.showMac.call(macInput.stationInput); } }; thisFlightSearchMarket.initMarketDateIdArray = function() { var i = 0; var marketDateId = null; var marketDate = {}; var marketDateIdArray = this.marketDateIdArray || []; for (i = 0; i < marketDateIdArray.length; i += 1) { marketDateId = marketDateIdArray[i]; marketDate = new SKYSALES.Class.MarketDate(); marketDate.init(marketDateId); marketDateArray[marketDateArray.length] = marketDate; } }; thisFlightSearchMarket.initMarketInputIdArray = function() { var i = 0; var marketInputId = null; var marketInput = {}; var marketInputIdArray = this.marketInputIdArray || []; for (i = 0; i < marketInputIdArray.length; i += 1) { marketInputId = marketInputIdArray[i]; marketInput = new SKYSALES.Class.MarketInput(); marketInput.init(marketInputId); marketInputArray[marketInputArray.length] = marketInput; } }; thisFlightSearchMarket.initStationInputIdArray = function() { var i = 0; var stationInputId = null; var stationInput = {}; var stationInputIdArray = this.stationInputIdArray; for (i = 0; i < stationInputIdArray.length; i += 1) { stationInputId = stationInputIdArray[i]; stationInput = new SKYSALES.Class.StationInput(); stationInput.init(stationInputId); stationInputArray[stationInputArray.length] = stationInput; } }; thisFlightSearchMarket.initStationDropDownIdArray = function() { var i = 0; var stationDropDownId = null; var stationDropDown = {}; var stationDropDownIdArray = this.stationDropDownIdArray; for (i = 0; i < stationDropDownIdArray.length; i += 1) { stationDropDownId = stationDropDownIdArray[i]; stationDropDown = new SKYSALES.Class.StationDropDown(); stationDropDown.init(stationDropDownId); stationDropDownArray[stationDropDownArray.length] = stationDropDown; } }; thisFlightSearchMarket.initValidationObjectRedirect = function() { var validationObjectIdArray = this.validationObjectIdArray || []; var i = 0; var validationObjectId = ''; var key = ''; var value = ''; var metaObjectParamToModify = null; var dropDownListToValidate = null; var metaObjectParam = null; for (i = 0; i < validationObjectIdArray.length; i += 1) { validationObjectId = validationObjectIdArray[i]; key = validationObjectId.key || ''; value = validationObjectId.value || ''; metaObjectParamToModify = $("object.metaobject>param[@value*='" + key + "']"); if (metaObjectParamToModify.length > 0) { dropDownListToValidate = $(":input#" + value); if (dropDownListToValidate.length > 0) { metaObjectParam = metaObjectParamToModify[0]; if ('value' in metaObjectParam) { var newStr = metaObjectParam.value; newStr = newStr.replace(key, value); metaObjectParam.value = newStr; } } } } }; return thisFlightSearchMarket; }; }
if (!SKYSALES.Class.MacInput) { SKYSALES.Class.MacInput = function() { var macInputBase = new SKYSALES.Class.SkySales(); var thisMacInput = SKYSALES.Util.extendObject(macInputBase); thisMacInput.macHash = SKYSALES.Util.getResource().macHash; thisMacInput.stationHash = SKYSALES.Util.getResource().stationHash; thisMacInput.stationInputId = ''; thisMacInput.macContainerId = ''; thisMacInput.macLabelId = ''; thisMacInput.macInputId = ''; thisMacInput.macContainer = {}; thisMacInput.stationInput = {}; thisMacInput.macInput = {}; thisMacInput.macLabel = {}; thisMacInput.showMac = function() { var stationCode = $(this).val(); stationCode = stationCode || ''; stationCode = stationCode.toUpperCase(); var station = null; var macCode = ''; var macText = ''; var mac = null; thisMacInput.macInput.removeAttr('checked'); thisMacInput.macContainer.hide(); station = thisMacInput.stationHash[stationCode]; if (station) { macCode = station.macCode; mac = thisMacInput.macHash[macCode]; if ((mac) && (mac.stations.length > 0)) { macText = mac.stations.join(); thisMacInput.macLabel.html(macText); thisMacInput.macContainer.show(); } } }; thisMacInput.addEvents = function() { thisMacInput.stationInput.change(thisMacInput.showMac); }; thisMacInput.setVars = function() { thisMacInput.stationInput = $('#' + thisMacInput.stationInputId); thisMacInput.macContainer = $('#' + thisMacInput.macContainerId); thisMacInput.macLabel = $('#' + thisMacInput.macLabelId); thisMacInput.macInput = $('#' + thisMacInput.macInputId); }; thisMacInput.init = function(paramObject) { macInputBase.init.call(this, paramObject); thisMacInput.macContainer.hide(); this.addEvents(); }; return thisMacInput; }; }
if (!SKYSALES.Class.MarketDate) {
    SKYSALES.Class.MarketDate = function() {
        var marketDateBase = new SKYSALES.Class.SkySales(); var thisMarketDate = SKYSALES.Util.extendObject(marketDateBase); thisMarketDate.dateFormat = SKYSALES.datepicker.datePickerFormat; thisMarketDate.dateDelimiter = SKYSALES.datepicker.datePickerDelimiter; thisMarketDate.marketDateId = ''; thisMarketDate.marketDate = null; thisMarketDate.marketDayId = ''; thisMarketDate.marketDay = null; thisMarketDate.marketMonthYearId = ''; thisMarketDate.marketMonthYear = null; thisMarketDate.setSettingsByObject = function(jsonObject) { marketDateBase.setSettingsByObject.call(this, jsonObject); var propName = ''; for (propName in jsonObject) { if (thisMarketDate.hasOwnProperty(propName)) { thisMarketDate[propName] = jsonObject[propName]; } } }; thisMarketDate.parseDate = function(dateStr) {
            var day = ''; var month = ''; var year = ''; var date = new Date(); var dateData = ''; var formatChar = ''; var datePickerArray = []; var i = 0; if (dateStr.indexOf(thisMarketDate.dateDelimiter) > -1) {
                datePickerArray = dateStr.split(thisMarketDate.dateDelimiter); for (i = 0; i < thisMarketDate.dateFormat.length; i += 1) {
                    dateData = datePickerArray[i]; if (dateData.charAt(0) === '0') { dateData = dateData.substring(1); }
                    formatChar = thisMarketDate.dateFormat.charAt(i); switch (formatChar) { case 'm': month = dateData; break; case 'd': day = dateData; break; case 'y': year = dateData; break; } 
                }
                date = new Date(year, month - 1, day);
            }
            return date;
        }; thisMarketDate.addEvents = function() { var datePickerManager = new SKYSALES.Class.DatePickerManager(); datePickerManager.isAOS = false; datePickerManager.yearMonth = thisMarketDate.marketMonthYear; datePickerManager.day = thisMarketDate.marketDay; datePickerManager.linkedDate = thisMarketDate.marketDate; datePickerManager.init(); }; thisMarketDate.setVars = function() { thisMarketDate.marketDate = $('#' + thisMarketDate.marketDateId); thisMarketDate.marketDay = $('#' + thisMarketDate.marketDayId); thisMarketDate.marketMonthYear = $('#' + thisMarketDate.marketMonthYearId); }; thisMarketDate.init = function(paramObject) { marketDateBase.init.call(this, paramObject); this.addEvents(); }; thisMarketDate.datesInOrder = function(dateArray) {
            var retVal = true; var dateA = null; var dateB = null; dateA = this.parseDate(dateArray[0]); dateB = this.parseDate(dateArray[1]); if (dateA > dateB) { retVal = false; }
            return retVal;
        }; thisMarketDate.datesIsEqual = function(dateArray, hours) {
            var retVal = true; var difHrs; var dateA = null; var dateNow = new Date(); dateA = this.parseDate(dateArray[0]); difHrs = this.GetDifhours(dateA, dateNow); if (difHrs <= hours) { retVal = false; }
            return retVal;
        }; thisMarketDate.dateNoFlights = function(dateArray) {
        var retVal = true; var minDate = null; var maxDate = new Date(); var setDayDate = new Date(); maxDate.setFullYear(maxDate.getFullYear() + 1); minDate = this.parseDate(dateArray[dateArray.length - 1]); if (minDate > maxDate) { retVal = false; }
            return retVal;
        }; thisMarketDate.GetDifhours = function(dateA, dateB) {
            var dayA = dateA.getDate(); var dayB = dateB.getDate(); var monthA = dateA.getMonth() + 1; var monthB = dateB.getMonth() + 1; var yearA = dateA.getFullYear(); var yearB = dateB.getFullYear(); var difHrs; if (monthA <= monthB && yearA <= yearB) { difHrs = (dayA - dayB) + 1; difHrs = difHrs * 24; }
            return difHrs;
        }; return thisMarketDate;
    };
}
if (!SKYSALES.Class.CountryInput) {
    SKYSALES.Class.CountryInput = function() {
        var countryInputBase = new SKYSALES.Class.SkySales(); var thisCountryInput = SKYSALES.Util.extendObject(countryInputBase); thisCountryInput.countryInfo = SKYSALES.Util.getResource().countryInfo; thisCountryInput.countryInputId = ''; thisCountryInput.input = {}; thisCountryInput.defaultCountry = ''; thisCountryInput.countryArray = []; thisCountryInput.populateCountryInput = function() { var selectParamObj = { 'selectBox': thisCountryInput.input, 'objectArray': thisCountryInput.countryArray, 'selectedItem': thisCountryInput.defaultCountry, 'showCode': true }; SKYSALES.Util.populateSelect(selectParamObj); }; thisCountryInput.addEvents = function() { }; thisCountryInput.setVars = function() {
            thisCountryInput.input = $('#' + thisCountryInput.countryInputId); var countryInfo = thisCountryInput.countryInfo; if (countryInfo) {
                if (countryInfo.CountryList) { thisCountryInput.countryArray = countryInfo.CountryList; }
                if (countryInfo.DefaultValue) { thisCountryInput.defaultCountry = countryInfo.DefaultValue; } 
            } 
        }; thisCountryInput.init = function(paramObject) { countryInputBase.init.call(this, paramObject); thisCountryInput.populateCountryInput(); this.addEvents(); }; return thisCountryInput;
    };
}
if (!SKYSALES.Class.FlightTypeInput) {
    SKYSALES.Class.FlightTypeInput = function() {
        var parent = new SKYSALES.Class.SkySales(); var thisFlightTypeInput = SKYSALES.Util.extendObject(parent); thisFlightTypeInput.flightSearch = null; thisFlightTypeInput.index = -1; thisFlightTypeInput.flightTypeId = ''; thisFlightTypeInput.hideInputIdArray = []; thisFlightTypeInput.hideInputArray = []; thisFlightTypeInput.input = {}; thisFlightTypeInput.updateFlightTypeHandler = function() {
            thisFlightTypeInput.flightSearch.updateFlightType(thisFlightTypeInput); var paramOrigin = $('#' + "ControlGroupSearchView_AvailabilitySearchInputSearchVieworiginStation2"); var paramDestination = $('#' + "ControlGroupSearchView_AvailabilitySearchInputSearchViewdestinationStation2"); var selectBoxOri = paramOrigin || null; var selectBoxDes = paramDestination || null; var selectBoxObjOri = null; var selectBoxObjDes = null; if (selectBoxOri) { selectBoxObjOri = selectBoxOri.get(0); }
            if (selectBoxDes) { selectBoxObjDes = selectBoxDes.get(0); }
            if (this.value === 'OpenJaw') { selectBoxObjOri.required = "true"; selectBoxObjOri.requirederror = "return Origin is a required field."; selectBoxObjDes.required = "true"; selectBoxObjDes.requirederror = "return Destination is a required field."; }
            else { selectBoxObjOri.required = "false"; selectBoxObjDes.required = "false"; } 
        }; thisFlightTypeInput.addEvents = function() { parent.addEvents.call(this); this.input.click(this.updateFlightTypeHandler); }; thisFlightTypeInput.getById = function(id) {
            var retVal = null; if (id) { retVal = window.document.getElementById(id); }
            return retVal;
        }; thisFlightTypeInput.setVars = function() {
            parent.setVars.call(this); var hideInputIndex = 0; var hideInput = null; var hideInputArray = []; thisFlightTypeInput.input = $('#' + this.flightTypeId); for (hideInputIndex = 0; hideInputIndex < this.hideInputIdArray.length; hideInputIndex += 1) { hideInput = thisFlightTypeInput.getById(this.hideInputIdArray[hideInputIndex]); if (hideInput) { hideInputArray[hideInputArray.length] = hideInput; } }
            thisFlightTypeInput.hideInputArray = $(hideInputArray);
        }; thisFlightTypeInput.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.addEvents(); }; return thisFlightTypeInput;
    };
}
if (!SKYSALES.Class.MarketInput) {
    SKYSALES.Class.MarketInput = function() {
        var marketInputBase = new SKYSALES.Class.SkySales(); var thisMarketInput = SKYSALES.Util.extendObject(marketInputBase); thisMarketInput.marketHash = SKYSALES.Util.getResource().marketHash; thisMarketInput.stationHash = SKYSALES.Util.getResource().stationHash; thisMarketInput.containerId = ''; thisMarketInput.container = null; thisMarketInput.disableInputId = ''; thisMarketInput.disableInput = null; thisMarketInput.originId = ''; thisMarketInput.origin = null; thisMarketInput.destinationId = ''; thisMarketInput.destination = null; thisMarketInput.toggleMarketCount = 0; thisMarketInput.toggleMarket = function() {
            if ((thisMarketInput.toggleMarketCount % 2) === 0) { $(':input', thisMarketInput.container).attr('disabled', 'disabled'); }
            else { $(':input', thisMarketInput.container).removeAttr('disabled'); }
            thisMarketInput.toggleMarketCount += 1;
        }; thisMarketInput.useComboBox = function(input) {
            var retVal = true; if (input && input.get(0) && input.get(0).options) { retVal = false; }
            return retVal;
        }; thisMarketInput.updateMarketOrigin = function() {
            var origin = $(this).val(); origin = origin.toUpperCase(); var destinationArray = thisMarketInput.marketHash[origin]; destinationArray = destinationArray || []; var selectParamObj = null; var useCombo = true; useCombo = thisMarketInput.useComboBox(thisMarketInput.destination); if (useCombo) { selectParamObj = { 'input': thisMarketInput.destination, 'options': destinationArray }; SKYSALES.Class.DropDown.getDropDown(selectParamObj); }
            else {
                selectParamObj = { 'selectBox': thisMarketInput.destination, 'objectArray': destinationArray, 'showCode': false }; var selectBox = selectParamObj.selectBox || null; var selectBoxObj = null; selectBoxObj = selectBox.get(0); thisID = selectBoxObj.id; if (thisID.substring(thisID.length - 1, thisID.length - 14) == "originStation" || thisID.substring(thisID.length - 1, thisID.length - 19) == "destinationStation") { SKYSALES.Util.populateSelectOriDestSattion(selectParamObj); }
                else { SKYSALES.Util.populateSelect(selectParamObj); } 
            } 
        }; thisMarketInput.addEvents = function() { thisMarketInput.origin.change(thisMarketInput.updateMarketOrigin); thisMarketInput.disableInput.click(thisMarketInput.toggleMarket); }; thisMarketInput.setVars = function() { thisMarketInput.container = $('#' + thisMarketInput.containerId); thisMarketInput.disableInput = $('#' + thisMarketInput.disableInputId); thisMarketInput.origin = $('#' + thisMarketInput.originId); thisMarketInput.destination = $('#' + thisMarketInput.destinationId); }; thisMarketInput.populateMarketInput = function(input) {
            var useCombo = true; var selectParamObj = {}; if ((input) && (input.length > 0)) {
                useCombo = thisMarketInput.useComboBox(input); if (useCombo) { selectParamObj = { 'input': input, 'options': thisMarketInput.stationHash }; SKYSALES.Class.DropDown.getDropDown(selectParamObj); }
                else {
                    selectParamObj = { 'selectBox': input, 'objectArray': thisMarketInput.stationHash, 'showCode': false }; var selectBox = selectParamObj.selectBox || null; var selectBoxObj = null; selectBoxObj = selectBox.get(0); thisID = selectBoxObj.id; if (thisID.substring(thisID.length - 1, thisID.length - 14) == "originStation" || thisID.substring(thisID.length - 1, thisID.length - 19) == "destinationStation") { SKYSALES.Util.populateSelectOriDestSattion(selectParamObj); }
                    else { SKYSALES.Util.populateSelect(selectParamObj); } 
                } 
            } 
        }; thisMarketInput.init = function(paramObject) { marketInputBase.init.call(this, paramObject); this.addEvents(); thisMarketInput.populateMarketInput(thisMarketInput.origin); thisMarketInput.populateMarketInput(thisMarketInput.destination); thisMarketInput.disableInput.click(); thisMarketInput.disableInput.removeAttr('checked'); }; return thisMarketInput;
    };
}
if (!SKYSALES.Class.StationInput) { SKYSALES.Class.StationInput = function() { var parent = new SKYSALES.Class.SkySales(); var thisStationInput = SKYSALES.Util.extendObject(parent); thisStationInput.stationInputId = ''; thisStationInput.stationInput = null; thisStationInput.setVars = function() { parent.setVars.call(this); thisStationInput.stationInput = $('#' + this.stationInputId); }; thisStationInput.init = function(json) { parent.init.call(this, json); this.addEvents(); }; return thisStationInput; }; }
if (!SKYSALES.Class.StationDropDown) { SKYSALES.Class.StationDropDown = function() { var stationDropDownBase = new SKYSALES.Class.SkySales(); var thisStationDropDown = SKYSALES.Util.extendObject(stationDropDownBase); thisStationDropDown.selectBoxId = ''; thisStationDropDown.selectBox = null; thisStationDropDown.inputId = ''; thisStationDropDown.input = null; thisStationDropDown.updateStationDropDown = function() { var stationCode = $(this).val(); thisStationDropDown.selectBox.val(stationCode); }; thisStationDropDown.updateStationInput = function() { var stationCode = $(this).val(); thisStationDropDown.input.val(stationCode); thisStationDropDown.input.change(); if (stationCode == "") { this.options[0].selected = 1; } }; thisStationDropDown.addEvents = function() { thisStationDropDown.input.change(thisStationDropDown.updateStationDropDown); thisStationDropDown.selectBox.change(thisStationDropDown.updateStationInput); }; thisStationDropDown.setVars = function() { thisStationDropDown.selectBox = $('#' + thisStationDropDown.selectBoxId); thisStationDropDown.input = $('#' + thisStationDropDown.inputId); }; thisStationDropDown.init = function(paramObject) { stationDropDownBase.init.call(this, paramObject); this.addEvents(); thisStationDropDown.input.change(); }; return thisStationDropDown; }; }
if (!SKYSALES.Class.TravelDocumentInput) {
    SKYSALES.Class.TravelDocumentInput = function() {
        var parent = new SKYSALES.Class.SkySales(); var thisTravelDocumentInput = SKYSALES.Util.extendObject(parent); thisTravelDocumentInput.travelDocumentInfoId = ''; thisTravelDocumentInput.travelDocumentInfo = null; thisTravelDocumentInput.delimiter = '_'; thisTravelDocumentInput.documentTypeId = ''; thisTravelDocumentInput.documentType = null; thisTravelDocumentInput.documentNumberId = ''; thisTravelDocumentInput.documentNumber = null; thisTravelDocumentInput.documentIssuingCountryId = ''; thisTravelDocumentInput.documentIssuingCountry = null; thisTravelDocumentInput.documentCountryOfBirthId = ''; thisTravelDocumentInput.documentCountryOfBirth = null; thisTravelDocumentInput.travelDocumentKey = ''; thisTravelDocumentInput.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.addEvents(); }; thisTravelDocumentInput.setVars = function() { parent.setVars.call(this); thisTravelDocumentInput.travelDocumentInfo = $('#' + this.travelDocumentInfoId); thisTravelDocumentInput.documentType = $('#' + this.documentTypeId); thisTravelDocumentInput.documentNumber = $('#' + this.documentNumberId); thisTravelDocumentInput.documentIssuingCountry = $('#' + this.documentIssuingCountryId); thisTravelDocumentInput.documentCountryOfBirth = $('#' + this.documentCountryOfBirthId); }; thisTravelDocumentInput.setTravelDocumentInfo = function() {
            var travelDocumentKey = ''; var documentType = this.documentType.val(); var documentNumber = this.documentNumber.val(); var documentIssuingCountry = this.documentIssuingCountry.val(); var documentCountryOfBirth = this.documentCountryOfBirth.val(); if (documentType && documentNumber && documentIssuingCountry && documentCountryOfBirth) { travelDocumentKey = documentType + this.delimiter + documentNumber + this.delimiter + documentIssuingCountry + this.delimiter + documentCountryOfBirth; this.travelDocumentInfo.val(travelDocumentKey); }
            return true;
        }; return thisTravelDocumentInput;
    };
}
if (!SKYSALES.Class.ControlGroup) { SKYSALES.Class.ControlGroup = function() { var parent = new SKYSALES.Class.SkySales(); var thisControlGroup = SKYSALES.Util.extendObject(parent); thisControlGroup.actionId = 'SkySales'; thisControlGroup.action = null; thisControlGroup.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.addEvents(); }; thisControlGroup.setVars = function() { parent.setVars.call(this); thisControlGroup.action = $('#' + this.actionId); }; thisControlGroup.addEvents = function() { parent.addEvents.call(this); this.action.click(this.validateHandler); }; thisControlGroup.validateHandler = function() { var retVal = thisControlGroup.validate(); return retVal; }; thisControlGroup.validate = function() { var actionDom = this.action.get(0); var retVal = window.validate(actionDom); return retVal; }; return thisControlGroup; }; SKYSALES.Class.ControlGroup.createObject = function(json) { SKYSALES.Util.createObject('controlGroup', 'ControlGroup', json); }; }
if (!SKYSALES.Class.ControlGroupRegister) {
    SKYSALES.Class.ControlGroupRegister = function() {
        var parent = new SKYSALES.Class.ControlGroup(); var thisControlGroupRegister = SKYSALES.Util.extendObject(parent); thisControlGroupRegister.travelDocumentInput = null; thisControlGroupRegister.setSettingsByObject = function(json) { parent.setSettingsByObject.call(this, json); var travelDocumentInput = new SKYSALES.Class.TravelDocumentInput(); travelDocumentInput.init(this.travelDocumentInput); thisControlGroupRegister.travelDocumentInput = travelDocumentInput; }; thisControlGroupRegister.validateHandler = function() { var retVal = thisControlGroupRegister.validate(); return retVal; }; thisControlGroupRegister.validate = function() {
            var retVal = false; retVal = this.travelDocumentInput.setTravelDocumentInfo(); if (retVal) { retVal = parent.validate.call(this); }
            return retVal;
        }; return thisControlGroupRegister;
    }; SKYSALES.Class.ControlGroupRegister.createObject = function(json) { SKYSALES.Util.createObject('controlGroupRegister', 'ControlGroupRegister', json); };
}
if (!SKYSALES.Class.ContactInput) {
    SKYSALES.Class.ContactInput = function() {
        var contactInput = new SKYSALES.Class.SkySales(); var thisContactInput = SKYSALES.Util.extendObject(contactInput); thisContactInput.clientId = ''; thisContactInput.keyIdArray = []; thisContactInput.keyArray = []; thisContactInput.clientStoreIdHash = null; thisContactInput.countryInputId = ''; thisContactInput.countryInput = null; thisContactInput.stateInputId = ''; thisContactInput.stateInput = null; thisContactInput.countryStateHash = null; thisContactInput.imContactId = ''; thisContactInput.imContact = null; thisContactInput.currentContactData = {}; thisContactInput.logOutButton = null; thisContactInput.clientHash = SKYSALES.Util.getResource().clientHash; thisContactInput.setSettingsByObject = function(jsonObject) { contactInput.setSettingsByObject.call(this, jsonObject); var propName = ''; for (propName in jsonObject) { if (thisContactInput.hasOwnProperty(propName)) { thisContactInput[propName] = jsonObject[propName]; } } }; thisContactInput.clearCurrentContact = function() { $("#" + thisContactInput.clientId + "_DropDownListTitle").val(""); $("#" + thisContactInput.clientId + "_TextBoxFirstName").val(""); $("#" + thisContactInput.clientId + "_TextBoxMiddleName").val(""); $("#" + thisContactInput.clientId + "_TextBoxLastName").val(""); $("#" + thisContactInput.clientId + "_TextBoxAddressLine1").val(""); $("#" + thisContactInput.clientId + "_TextBoxAddressLine2").val(""); $("#" + thisContactInput.clientId + "_TextBoxAddressLine3").val(""); $("#" + thisContactInput.clientId + "_TextBoxCity").val(""); $("#" + thisContactInput.clientId + "_DropDownListStateProvince").val(""); $("#" + thisContactInput.clientId + "_DropDownListCountry").val(""); $("#" + thisContactInput.clientId + "_TextBoxPostalCode").val(""); $("#" + thisContactInput.clientId + "_TextBoxHomePhone").val(""); $("#" + thisContactInput.clientId + "_TextBoxWorkPhone").val(""); $("#" + thisContactInput.clientId + "_TextBoxOtherPhone").val(""); $("#" + thisContactInput.clientId + "_TextBoxFax").val(""); $("#" + thisContactInput.clientId + "_TextBoxEmailAddress").val(""); }; thisContactInput.populateCurrentContact = function() {
            if (thisContactInput.currentContactData) {
                if (thisContactInput.imContact.attr("checked") === true) { $("#" + thisContactInput.clientId + "_DropDownListTitle").val(thisContactInput.currentContactData.title); $("#" + thisContactInput.clientId + "_TextBoxFirstName").val(thisContactInput.currentContactData.firstName); $("#" + thisContactInput.clientId + "_TextBoxMiddleName").val(thisContactInput.currentContactData.middleName); $("#" + thisContactInput.clientId + "_TextBoxLastName").val(thisContactInput.currentContactData.lastName); $("#" + thisContactInput.clientId + "_TextBoxAddressLine1").val(thisContactInput.currentContactData.streetAddressOne); $("#" + thisContactInput.clientId + "_TextBoxAddressLine2").val(thisContactInput.currentContactData.streetAddressTwo); $("#" + thisContactInput.clientId + "_TextBoxAddressLine3").val(thisContactInput.currentContactData.streetAddressThree); $("#" + thisContactInput.clientId + "_TextBoxCity").val(thisContactInput.currentContactData.city); $("#" + thisContactInput.clientId + "_DropDownListStateProvince").val(thisContactInput.currentContactData.stateProvince); $("#" + thisContactInput.clientId + "_DropDownListCountry").val(thisContactInput.currentContactData.country); $("#" + thisContactInput.clientId + "_TextBoxPostalCode").val(thisContactInput.currentContactData.postalCode); $("#" + thisContactInput.clientId + "_TextBoxHomePhone").val(thisContactInput.currentContactData.eveningPhone); $("#" + thisContactInput.clientId + "_TextBoxWorkPhone").val(thisContactInput.currentContactData.dayPhone); $("#" + thisContactInput.clientId + "_TextBoxOtherPhone").val(thisContactInput.currentContactData.mobilePhone); $("#" + thisContactInput.clientId + "_TextBoxFax").val(thisContactInput.currentContactData.faxPhone); $("#" + thisContactInput.clientId + "_TextBoxEmailAddress").val(thisContactInput.currentContactData.email); }
                else { thisContactInput.clearCurrentContact(); } 
            } 
        }; thisContactInput.populateCountryStateHash = function() {
            var i = 0; var selectBox = thisContactInput.stateInput.get(0); var country = ''; var stateArray = []; var countryStateArray = []; var option = null; var state = ''; var stateName = ''; var stateObject = {}; var countryStateHash = {}; if (selectBox && selectBox.options) {
                thisContactInput.countryStateHash = {}; countryStateHash.customStates = []; countryStateHash.allStates = []; for (i = 0; i < selectBox.options.length; i += 1) {
                    option = selectBox.options[i]; state = option.value; stateName = option.text; stateObject = { 'name': stateName, 'code': state }; countryStateArray = option.value.split('|'); if (countryStateArray.length === 2) { country = countryStateArray[0]; stateArray = countryStateHash[country]; stateArray = stateArray || []; stateArray[stateArray.length] = stateObject; countryStateHash[country] = stateArray; countryStateHash.allStates[countryStateHash.allStates.length] = stateObject; }
                    else { countryStateHash.customStates[countryStateHash.customStates.length] = stateObject; } 
                }
                thisContactInput.countryStateHash = countryStateHash;
            } 
        }; thisContactInput.updateCountry = function() { var countryState = thisContactInput.stateInput.val(); var countryStateArray = countryState.split('|'); var country = ''; if (countryStateArray.length === 2) { country = countryStateArray[0]; thisContactInput.countryInput.val(country); } }; thisContactInput.updateState = function() {
            var country = thisContactInput.countryInput.val(); var stateArray = []; var stateObject = {}; var stateObjectArray = []; var i = 0; if (!thisContactInput.countryStateHash) { thisContactInput.populateCountryStateHash(); }
            stateArray = thisContactInput.countryStateHash[country]; stateArray = stateArray || []; if (stateArray.length === 0) { stateArray = thisContactInput.countryStateHash.allStates; }
            for (i = 0; i < thisContactInput.countryStateHash.customStates.length; i += 1) { stateObject = thisContactInput.countryStateHash.customStates[i]; stateObjectArray[stateObjectArray.length] = stateObject; }
            for (i = 0; i < stateArray.length; i += 1) { stateObject = stateArray[i]; stateObjectArray[stateObjectArray.length] = stateObject; }
            var paramObject = { 'objectArray': stateObjectArray, 'selectBox': thisContactInput.stateInput, 'showCode': false, 'clearOptions': true }; SKYSALES.Util.populateSelect(paramObject);
        }; thisContactInput.getKey = function() {
            var i = 0; var keyArray = thisContactInput.keyArray; var keyObject = null; var key = ''; for (i = 0; i < keyArray.length; i += 1) { keyObject = keyArray[i]; key += keyObject.val(); }
            key = thisContactInput.clientId + '_' + key; return key;
        }; thisContactInput.populateClientStoreIdHash = function() { var clientHash = thisContactInput.clientHash; var i = 0; var keyValueStr = ''; var keyValueArray = []; var singleKeyValueStr = ''; var eqIndex = -1; var key = thisContactInput.getKey(); var value = null; thisContactInput.clientStoreIdHash = {}; if (key && clientHash && clientHash[key]) { thisContactInput.clientStoreIdHash = thisContactInput.clientStoreIdHash || {}; keyValueStr = clientHash[key]; keyValueArray = keyValueStr.split('&'); for (i = 0; i < keyValueArray.length; i += 1) { singleKeyValueStr = keyValueArray[i]; eqIndex = singleKeyValueStr.indexOf('='); if (eqIndex > -1) { key = singleKeyValueStr.substring(0, eqIndex); value = singleKeyValueStr.substring(eqIndex + 1, singleKeyValueStr.length); if (key) { thisContactInput.clientStoreIdHash[key] = value; } } } } }; thisContactInput.autoPopulateForm = function() { thisContactInput.populateClientStoreIdHash(); var clientStoreIdHash = thisContactInput.clientStoreIdHash; var key = ''; var value = ''; for (key in clientStoreIdHash) { if (clientStoreIdHash.hasOwnProperty(key)) { value = clientStoreIdHash[key]; $('#' + key).val(value); } } }; thisContactInput.addEvents = function() {
            contactInput.addEvents.call(this); var i = 0; var keyArray = thisContactInput.keyArray; var key = null; for (i = 0; i < keyArray.length; i += 1) { key = keyArray[i]; key.change(thisContactInput.autoPopulateForm); }
            thisContactInput.imContact.click(thisContactInput.populateCurrentContact); thisContactInput.logOutButton.click(thisContactInput.clearCurrentContact);
        }; thisContactInput.setVars = function() {
            contactInput.setVars.call(this); var i = 0; var keyIdArray = thisContactInput.keyIdArray; var keyArray = thisContactInput.keyArray; var keyId = ''; for (i = 0; i < keyIdArray.length; i += 1) { keyId = keyIdArray[i]; keyArray[keyArray.length] = $('#' + keyId); }
            thisContactInput.countryInput = $('#' + thisContactInput.countryInputId); thisContactInput.stateInput = $('#' + thisContactInput.stateInputId); thisContactInput.imContact = $('#' + thisContactInput.imContactId); thisContactInput.logOutButton = $('#MemberLoginContactView_ButtonLogOut');
        }; thisContactInput.init = function(paramObj) { this.setSettingsByObject(paramObj); this.setVars(); this.addEvents(); }; return thisContactInput;
    }; SKYSALES.Class.ContactInput.createObject = function(json) { SKYSALES.Util.createObject('contactInput', 'ContactInput', json); };
}
if (!SKYSALES.Class.ToggleView) { SKYSALES.Class.ToggleView = function() { var toggleView = new SKYSALES.Class.SkySales(); var thisToggleView = SKYSALES.Util.extendObject(toggleView); thisToggleView.showId = ''; thisToggleView.hideId = ''; thisToggleView.elementId = ''; thisToggleView.show = null; thisToggleView.hide = null; thisToggleView.element = null; thisToggleView.setVars = function() { toggleView.setVars.call(this); thisToggleView.show = $('#' + thisToggleView.showId); thisToggleView.hide = $('#' + thisToggleView.hideId); thisToggleView.element = $('#' + thisToggleView.elementId); }; thisToggleView.init = function(paramObj) { this.setSettingsByObject(paramObj); this.setVars(); this.addEvents(); }; thisToggleView.updateShowHandler = function() { thisToggleView.element.show('slow'); }; thisToggleView.updateHideHandler = function() { thisToggleView.element.hide(); }; thisToggleView.addEvents = function() { toggleView.addEvents.call(this); thisToggleView.show.click(thisToggleView.updateShowHandler); thisToggleView.hide.click(thisToggleView.updateHideHandler); }; return thisToggleView; }; }
if (!SKYSALES.Class.PaymentInput) {
    SKYSALES.Class.PaymentInput = function() {
        var parent = SKYSALES.Class.SkySales(); var thisPaymentInput = SKYSALES.Util.extendObject(parent); thisPaymentInput.dccOfferInfoId = ''; thisPaymentInput.foreignAmountId = ''; thisPaymentInput.foreignCurrencyId = ''; thisPaymentInput.foreignCurrencySymbolId = ''; thisPaymentInput.ownCurrencyAmountId = ''; thisPaymentInput.ownCurrencyId = ''; thisPaymentInput.ownCurrencySymbolId = ''; thisPaymentInput.rejectRadioBtnIdId = ''; thisPaymentInput.acceptRadioBtnIdId = ''; thisPaymentInput.doubleOptOutId = ''; thisPaymentInput.inlineDCCAjaxSucceededId = ''; thisPaymentInput.dccId = ''; thisPaymentInput.inlineDCCConversionLabelId = ''; thisPaymentInput.amountInputId = ''; thisPaymentInput.accountNumberInputId = ''; thisPaymentInput.inlineDCCOffer = null; thisPaymentInput.currencyCode = null; thisPaymentInput.feeAmt = null; thisPaymentInput.setSettingsByObject = function(json) { parent.setSettingsByObject.call(this, json); }; thisPaymentInput.setVars = function() { thisPaymentInput.dcc = $('#' + this.dccId); thisPaymentInput.inlineDCCConversionLabel = $('#' + this.inlineDCCConversionLabelId); thisPaymentInput.accountNoTextBox = $('#' + this.accountNumberInputId); thisPaymentInput.amountTextBox = $('#' + this.amountInputId); thisPaymentInput.inlineDCCAjaxSucceeded = $('#' + this.inlineDCCAjaxSucceededId); }; thisPaymentInput.inlineDCCAjaxRequestHandler = function() { thisPaymentInput.getInlineDCC(); }; thisPaymentInput.addEvents = function() { this.amountTextBox.change(this.inlineDCCAjaxRequestHandler); this.accountNoTextBox.change(this.inlineDCCAjaxRequestHandler); }; thisPaymentInput.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.addEvents(); }; thisPaymentInput.getInlineDCC = function(amount, acctNumber) {
            var params = {}; if ('True' === this.inlineDCCOffer) {
                if (!acctNumber) { acctNumber = this.accountNoTextBox.val(); }
                if (!amount) { amount = this.amountTextBox.val(); }
                params = { 'amount': amount, 'paymentFee': this.feeAmt, 'currencyCode': this.currencyCode, 'accountNumber': acctNumber }; if (this.currencyCode && amount && acctNumber && (0 < parseFloat(amount)) && (12 <= acctNumber.length)) { this.inlineDCCAjaxSucceeded.val('false'); $.get('DCCOfferAjax-Resource.aspx', params, this.inlineDCCResponseHandler); } 
            } 
        }; thisPaymentInput.setVarsAfterAjaxResponse = function(jData) { var offerInfo = $('#' + this.dccOfferInfoId, jData); thisPaymentInput.foreignAmount = $('#' + this.foreignAmountId, offerInfo).text(); thisPaymentInput.foreignCurrency = $('#' + this.foreignCurrencyId, offerInfo).text(); thisPaymentInput.foreignCurrencySymbol = $('#' + this.foreignCurrencySymbolId, offerInfo).text(); thisPaymentInput.ownCurrencyAmount = $('#' + this.ownCurrencyAmountId, offerInfo).text(); thisPaymentInput.ownCurrency = $('#' + this.ownCurrencyId, offerInfo).text(); thisPaymentInput.ownCurrencySymbol = $('#' + this.ownCurrencySymbolId, offerInfo).text(); thisPaymentInput.acceptRadioBtnID = $('#' + this.acceptRadioBtnIdId, offerInfo).text(); thisPaymentInput.rejectRadioBtnID = $('#' + this.rejectRadioBtnIdId, offerInfo).text(); thisPaymentInput.acceptRadioBtn = $('#' + this.acceptRadioBtnID); thisPaymentInput.doubleOptOut = $('#' + this.doubleOptOutId, offerInfo).text(); thisPaymentInput.radioButtonInlineDccStatusOfferAccept = $('#' + this.acceptRadioBtnID); thisPaymentInput.radioButtonInlineDccStatusOfferReject = $('#' + this.rejectRadioBtnID); }; thisPaymentInput.foreignUpdateConversionLabel = function() { this.inlineDCCConversionLabel.text('(' + ' ' + this.foreignAmount + ' ' + this.foreignCurrency + ')'); }; thisPaymentInput.ownUpdateConversionLabel = function() { this.inlineDCCConversionLabel.text(''); }; thisPaymentInput.noThanks = function() { $('#dccCont').show('slow'); }; thisPaymentInput.noShowThanks = function() { $('#dccCont').hide('slow'); }; thisPaymentInput.inlineDccStatusOfferAccept = function() { this.foreignUpdateConversionLabel(); this.noShowThanks(); }; thisPaymentInput.inlineDccStatusOfferReject = function() { this.ownUpdateConversionLabel(); this.noThanks(); }; thisPaymentInput.inlineDccStatusOfferAcceptHandler = function() { thisPaymentInput.inlineDccStatusOfferAccept(); }; thisPaymentInput.inlineDccStatusOfferRejectHandler = function() { thisPaymentInput.inlineDccStatusOfferReject(); }; thisPaymentInput.addEventsAfterAjaxResponse = function() { this.radioButtonInlineDccStatusOfferAccept.click(this.inlineDccStatusOfferAcceptHandler); this.radioButtonInlineDccStatusOfferReject.click(this.inlineDccStatusOfferRejectHandler); }; thisPaymentInput.updateAcceptRadioBtn = function() { var acceptChecked = this.acceptRadioBtn.attr('checked'); if (acceptChecked) { this.foreignUpdateConversionLabel(); } }; thisPaymentInput.updateInlineDCCOffer = function(data) {
            this.inlineDCCAjaxSucceeded.val('true'); var responseDCCElement = null; if (data) {
                this.dcc.empty(); var jData = $(data); responseDCCElement = $('#' + this.dccId, jData); if (responseDCCElement && responseDCCElement.length) { this.dcc.prepend(responseDCCElement.children()); }
                this.setVarsAfterAjaxResponse(jData); this.addEventsAfterAjaxResponse(); this.updateAcceptRadioBtn();
            } 
        }; thisPaymentInput.inlineDCCResponseHandler = function(data) { thisPaymentInput.updateInlineDCCOffer(data); }; return thisPaymentInput;
    }; SKYSALES.Class.PaymentInput.createObject = function(json) { SKYSALES.Util.createObject('paymentInput', 'PaymentInput', json); };
}
if (!SKYSALES.Class.PriceDisplay) { SKYSALES.Class.PriceDisplay = function() { var parent = new SKYSALES.Class.SkySales(); var thisPriceDisplay = SKYSALES.Util.extendObject(parent); thisPriceDisplay.toggleViewIdArray = null; thisPriceDisplay.init = function(json) { this.setSettingsByObject(json); var toggleViewIdArray = this.toggleViewIdArray || []; var i = 0; var toggleView = null; for (i = 0; i < toggleViewIdArray.length; i += 1) { toggleView = new SKYSALES.Class.ToggleView(); toggleView.init(toggleViewIdArray[i]); thisPriceDisplay.toggleViewIdArray[i] = toggleView; } }; return thisPriceDisplay; }; SKYSALES.Class.PriceDisplay.createObject = function(json) { SKYSALES.Util.createObject('priceDisplay', 'PriceDisplay', json); }; SKYSALES.Class.PriceDisplay.initTaxesAndFees = function() { $("#priceDetails").each(function() { $(this).find("#TaxesAndFeesLink").each(function() { var link = $(this); link.hover(function() { $(this).siblings("#showTax").css({ 'display': 'block' }); }, function() { $(this).siblings("#showTax").css({ 'display': 'none' }); }); }); }); }; }
if (!SKYSALES.Class.FlightDisplay) { SKYSALES.Class.FlightDisplay = function() { var parent = new SKYSALES.Class.SkySales(); var thisFlightDisplay = SKYSALES.Util.extendObject(parent); thisFlightDisplay.toggleViewIdArray = null; thisFlightDisplay.init = function(json) { this.setSettingsByObject(json); var toggleViewIdArray = this.toggleViewIdArray || []; var i = 0; var toggleView = null; for (i = 0; i < toggleViewIdArray.length; i += 1) { toggleView = new SKYSALES.Class.ToggleView(); toggleView.init(toggleViewIdArray[i]); thisFlightDisplay.toggleViewIdArray[i] = toggleView; } }; return thisFlightDisplay; }; SKYSALES.Class.FlightDisplay.createObject = function(json) { SKYSALES.Util.createObject('flightDisplay', 'FlightDisplay', json); }; }
if (!SKYSALES.Class.RandomImage) { SKYSALES.Class.RandomImage = function() { var parent = new SKYSALES.Class.SkySales(); var thisRandomImage = SKYSALES.Util.extendObject(parent); thisRandomImage.imageUriArray = []; thisRandomImage.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.setAsBackground(); }; thisRandomImage.getRandomNumber = function() { var randomNumberMax = this.imageUriArray.length; var randomNumber = Math.floor(Math.random() * randomNumberMax); return randomNumber; }; thisRandomImage.setAsBackground = function() { var randomNumber = this.getRandomNumber(); var uri = 'url(' + this.imageUriArray[randomNumber] + ')'; this.container.css('background-image', uri); }; return thisRandomImage; }; SKYSALES.Class.RandomImage.createObject = function(json) { SKYSALES.Util.createObject('randomImage', 'RandomImage', json); }; }
SKYSALES.Class.DropDown = function(paramObject) {
    paramObject = paramObject || {}; var thisDrop = this; thisDrop.container = {}; thisDrop.name = ''; thisDrop.options = []; thisDrop.dropDownContainer = null; thisDrop.dropDownContainerInput = null; thisDrop.document = null; thisDrop.optionList = null; thisDrop.optionActiveClass = 'optionActive'; thisDrop.timeOutObj = null; thisDrop.timeOut = 225; thisDrop.minCharLength = 2; thisDrop.optionMax = 100; thisDrop.html = '<div></div><div class="dropDownContainer"></div>'; thisDrop.autoComplete = true; thisDrop.setSettingsByObject = function(jsonObject) { var prop = null; for (prop in jsonObject) { if (thisDrop.hasOwnProperty(prop)) { thisDrop[prop] = jsonObject[prop]; } } }; thisDrop.getOptionHtml = function(search) {
        search = search || ''; var option = {}; var prop = ''; var optionHtml = ''; var optionCount = 0; var optionHash = thisDrop.options; var re = new RegExp('^' + search, 'i'); if (search.length < thisDrop.minCharLength) { optionHtml = ''; }
        else {
            for (prop in optionHash) {
                if (optionHash.hasOwnProperty(prop)) {
                    option = optionHash[prop]; option.name = option.name || ''; option.code = option.code || ''; if (option.name.match(re) || option.code.match(re)) { optionHtml += '<div><span>' + option.code + '</span>' + option.name + ' (' + option.code + ')' + '</div>'; optionCount += 1; }
                    if (optionCount >= thisDrop.optionMax) { break; } 
                } 
            } 
        }
        return optionHtml;
    }; thisDrop.close = function() {
        if (thisDrop.timeOutObj) { window.clearTimeout(thisDrop.timeOutObj); }
        thisDrop.document.unbind('click', thisDrop.close); if (thisDrop.optionList) { thisDrop.optionList.unbind('hover'); thisDrop.optionList.unbind('click'); }
        thisDrop.optionList = null; thisDrop.dropDownContainer.html('');
    }; thisDrop.getActiveOptionIndex = function() {
        var activeOptionIndex = -1; var activeOption = $('.' + thisDrop.optionActiveClass, thisDrop.dropDownContainer); if (thisDrop.optionList && (activeOption.length > 0)) { activeOptionIndex = thisDrop.optionList.index(activeOption[0]); }
        return activeOptionIndex;
    }; thisDrop.arrowDown = function() {
        var activeOptionIndex = thisDrop.getActiveOptionIndex(); if (thisDrop.optionList) {
            if ((activeOptionIndex === -1) && (thisDrop.optionList.length > 0)) { thisDrop.optionActive.call(thisDrop.optionList[0]); }
            else if (thisDrop.optionList.length > activeOptionIndex + 1) { thisDrop.optionInActive.call(thisDrop.optionList[activeOptionIndex]); thisDrop.optionActive.call(thisDrop.optionList[activeOptionIndex + 1]); }
            else { thisDrop.arrowDownOpen(); } 
        }
        else { thisDrop.arrowDownOpen(); } 
    }; thisDrop.arrowDownOpen = function() { var oldMinCharLength = thisDrop.minCharLength; thisDrop.minCharLength = 0; thisDrop.open(); thisDrop.minCharLength = oldMinCharLength; }; thisDrop.arrowUp = function() {
        var activeOptionIndex = thisDrop.getActiveOptionIndex(); if (thisDrop.optionList) {
            if ((activeOptionIndex === -1) && (thisDrop.optionList.length > 0)) { thisDrop.optionActive.call(thisDrop.optionList[0]); }
            else if ((activeOptionIndex > 0) && (thisDrop.optionList.length > 0)) { thisDrop.optionInActive.call(thisDrop.optionList[activeOptionIndex]); thisDrop.optionActive.call(thisDrop.optionList[activeOptionIndex - 1]); } 
        } 
    }; thisDrop.selectButton = function() {
        var activeOptionIndex = thisDrop.getActiveOptionIndex(); var oldOptionMax = thisDrop.optionMax; if (activeOptionIndex > -1) { thisDrop.selectOption.call(thisDrop.optionList[activeOptionIndex]); }
        else if (thisDrop.autoComplete === true) {
            thisDrop.optionMax = 1; thisDrop.open(); if (thisDrop.optionList && (thisDrop.optionList.length > 0)) { thisDrop.selectOption.call(thisDrop.optionList[0]); }
            thisDrop.optionMax = oldOptionMax;
        } 
    }; thisDrop.keyEvent = function(key) {
        var retVal = true; var keyNum = key.which; if (keyNum === 40) { thisDrop.arrowDown(); thisDrop.autoComplete = true; retVal = false; }
        else if (keyNum === 38) { thisDrop.arrowUp(); thisDrop.autoComplete = true; retVal = false; }
        else if (keyNum === 9) { thisDrop.selectButton(); thisDrop.inputBlur(); }
        else if (keyNum === 13) { thisDrop.selectButton(); thisDrop.autoComplete = false; retVal = false; }
        else { thisDrop.autoComplete = true; }
        return retVal;
    }; thisDrop.inputKeyEvent = function(key) {
        var retVal = true; var keyNum = key.which; if ((keyNum !== 40) && (keyNum !== 38) && (keyNum !== 9) && (keyNum !== 13)) {
            if (thisDrop.timeOutObj) { window.clearTimeout(thisDrop.timeOutObj); }
            thisDrop.timeOutObj = window.setTimeout(thisDrop.open, thisDrop.timeOut); retVal = false;
        }
        return retVal;
    }; thisDrop.catchEvent = function() { return false; }; thisDrop.open = function() {
        var iframeHtml = ''; var iframe = null; var search = thisDrop.dropDownContainerInput.val(); var optionHtml = thisDrop.getOptionHtml(search); var height = 0; var containerWidth = 0; thisDrop.dropDownContainer.html(optionHtml); thisDrop.addOptionEvents(); thisDrop.dropDownContainer.click(thisDrop.catchEvent); thisDrop.document.click(thisDrop.close); thisDrop.dropDownContainer.show(); if (thisDrop.optionList && (thisDrop.optionList.length > 0) && thisDrop.optionActive) { thisDrop.optionActive.call(thisDrop.optionList[0]); }
        containerWidth = thisDrop.dropDownContainer.width(); if ($.browser.msie) { height = thisDrop.dropDownContainer.height(); iframeHtml = '<iframe src="#"></iframe>'; thisDrop.dropDownContainer.prepend(iframeHtml); iframe = $('iframe', thisDrop.dropDownContainer); iframe.width(containerWidth); iframe.height(height); } 
    }; thisDrop.optionActive = function() { var option = $(this); thisDrop.optionList.removeClass(thisDrop.optionActiveClass); option.addClass(thisDrop.optionActiveClass); }; thisDrop.optionInActive = function() { var option = $(this); option.removeClass(thisDrop.optionActiveClass); }; thisDrop.selectOption = function() { var text = $('span', this).text(); thisDrop.dropDownContainerInput.val(text); thisDrop.close(); thisDrop.dropDownContainerInput.change(); }; thisDrop.addOptionEvents = function() { thisDrop.optionList = $('div', thisDrop.dropDownContainer); thisDrop.optionList.hover(thisDrop.optionActive, thisDrop.optionInActive); thisDrop.optionList.click(thisDrop.selectOption); }; thisDrop.inputBlur = function() { thisDrop.close(); }; thisDrop.addEvents = function(paramObject) { thisDrop.dropDownContainerInput = paramObject.input; thisDrop.dropDownContainer = $('div.dropDownContainer', thisDrop.container); thisDrop.document = $(document); thisDrop.dropDownContainerInput.keyup(thisDrop.inputKeyEvent); thisDrop.dropDownContainerInput.keydown(thisDrop.keyEvent); }; thisDrop.init = function(paramObject) { thisDrop.setSettingsByObject(paramObject); var html = thisDrop.html; paramObject.input.attr('autocomplete', 'off'); paramObject.input.wrap('<span class="dropDownOuterContainer"></span>'); paramObject.input.after(html); thisDrop.container = paramObject.input.parent('span.dropDownOuterContainer'); thisDrop.addEvents(paramObject); SKYSALES.Class.DropDown.dropDownArray[SKYSALES.Class.DropDown.dropDownArray.length] = thisDrop; }; thisDrop.init(paramObject); return thisDrop;
}; SKYSALES.Class.DropDown.dropDownArray = []; SKYSALES.Class.DropDown.getDropDown = function(selectParamObj) {
    var retVal = null; var i = 0; var dropDown = null; var dropDownArray = SKYSALES.Class.DropDown.dropDownArray; var input = null; var inputCompare = selectParamObj.input.get(0); for (i = 0; i < dropDownArray.length; i += 1) { dropDown = dropDownArray[i]; input = dropDown.dropDownContainerInput.get(0); if ((input) && (inputCompare) && (input === inputCompare)) { retVal = dropDownArray[i]; if (selectParamObj.options) { retVal.options = selectParamObj.options; } } }
    if (!retVal) { retVal = new SKYSALES.Class.DropDown(selectParamObj); }
    return retVal;
}; if (SKYSALES.Class.DatePickerManager === undefined) {
    SKYSALES.Class.DatePickerManager = function() {
        var thisDatePickerManager = this; thisDatePickerManager.isAOS = false; thisDatePickerManager.yearMonth = null; thisDatePickerManager.day = null; thisDatePickerManager.linkedDate = null; var allDayOptionArray = []; var yearMonthDelimiter = '-'; var yearMonthFormatString = 'yy-mm'; var firstDateOption = 'first'; var fullDateFormatString = 'mm/dd/yy'; var validateYearMonthRegExp = new RegExp('\\d{4}-\\d{2}'); var getDaysInMonth = function(dateParam) { var daysNotInMonthDate = new Date(dateParam.getFullYear(), dateParam.getMonth(), 32); var daysNotInMonth = daysNotInMonthDate.getDate(); return 32 - daysNotInMonth; }; var validateDay = function(dayParam) { return dayParam.match(/\d{2}/); }; var validateYearMonth = function(yearMonthParam) { yearMonthParam = yearMonthParam || ''; return yearMonthParam.match(validateYearMonthRegExp); }; var getDate = function(yearMonthParam, dayParam) {
            var retDate = new Date(); var yearMonthArray = yearMonthParam.split(yearMonthDelimiter); var yearIndex = 0; var monthIndex = 1; if (true === thisDatePickerManager.isAOS) { yearIndex = 1; monthIndex = 0; }
            var yearVal = yearMonthArray[yearIndex]; var monthVal = yearMonthArray[monthIndex] - 1; retDate = new Date(yearVal, monthVal, dayParam); return retDate;
        }; var parseDate = function(yearMonthParam, dayParam) {
            var retDate = new Date(); var validateDayVal = validateDay(dayParam); var validateYearMonthVal = validateYearMonth(yearMonthParam); if (validateDayVal && validateYearMonthVal) {
                var date = getDate(yearMonthParam, dayParam); var daysInMonth = getDaysInMonth(date); var dayVal = dayParam; if (dayParam > daysInMonth) { dayVal = daysInMonth; }
                retDate = new Date(date.getFullYear(), date.getMonth(), dayVal);
            }
            else { retDate = new Date(); }
            return retDate;
        };
        var readLinked = function() {
            var date = parseDate(thisDatePickerManager.yearMonth.val(), thisDatePickerManager.day.val());
            var dateString = $.datepicker.formatDate(fullDateFormatString, date);
            thisDatePickerManager.linkedDate.val(dateString);
            return {}; 
        };
        var dayResizeAndSet = function(dateParam, objClone) {
            var todayDate = new Date();
            var todayDay = todayDate.getDate();
            var todayMonth = todayDate.getMonth();
            var todayYear = todayDate.getYear();
            var todayYearMonth = todayYear.toString() + todayMonth.toString();
            //var todayYearMonth = todayDate.getYear() + todayDate.getMonth();

            var dateParamMonth = dateParam.getMonth();
            var dateParamYear = dateParam.getYear();
            var dateParamYearMonth = dateParamYear.toString() + dateParamMonth.toString();
            //var dateParamYearMonth = dateParam.getYear() + dateParam.getMonth();
            var monthYearIsCurrent = (todayYearMonth === dateParamYearMonth);
            var todayIsPastSecond = (2 < todayDay);
            var trimInvalidDays = todayIsPastSecond && monthYearIsCurrent;
            var day = dateParam.getDate();
            var daysInMonth = getDaysInMonth(dateParam);
            var daysInMonthDifference = 31 - daysInMonth;
            var dayOptionArray = SKYSALES.Util.cloneArray(allDayOptionArray);
            var removeDaysAfterThisIndex = 31;
            if (daysInMonthDifference > 0) {
                removeDaysAfterThisIndex = 31 - daysInMonthDifference;
                dayOptionArray.splice(removeDaysAfterThisIndex, daysInMonthDifference);
            }
            if (trimInvalidDays) {
                dayOptionArray.splice(0, todayDay - 1);
            }
//            var SelectedDay = day;
//            if (!monthYearIsCurrent) {
//                SelectedDay = 0;
//            }
            var daySelectParams = {
            'selectedItem': day, 'objectArray': dayOptionArray, 'selectBox': thisDatePickerManager.day, 'clearOptions': true
//            'selectedItem': SelectedDay, 'objectArray': dayOptionArray, 'selectBox': thisDatePickerManager.day, 'clearOptions': true
            };

            if (objClone == null) {
                SKYSALES.Util.populateSelect(daySelectParams);
            }
            else {
                SKYSALES.Util.populateSelectByOject(daySelectParams, objClone);
            }
        };
        var yearMonthUpdate = function() {
            var dayVal = thisDatePickerManager.day.val();
            var date = getDate(thisDatePickerManager.yearMonth.val(), 1);
            var daysInMonth = getDaysInMonth(date);
            if (dayVal > daysInMonth) {
                dayVal = daysInMonth;
            }
            date = new Date(date.getFullYear(), date.getMonth(), dayVal);
            dayResizeAndSet(date);
            thisDatePickerManager.linkedDate.val($.datepicker.formatDate(fullDateFormatString, date));
            if (this.name == 'ControlGroupSearchView$AvailabilitySearchInputSearchView$DropDownListMarketMonth1' && this.tagName == 'SELECT') {
                var myMarketMonth2 = document.getElementById('ControlGroupSearchView_AvailabilitySearchInputSearchView_DropDownListMarketMonth2');
                myMarketMonth2.options[this.selectedIndex].selected = true;
                var myMarketDay2 = document.getElementById('ControlGroupSearchView_AvailabilitySearchInputSearchView_DropDownListMarketDay2');
                dayResizeAndSet(date, myMarketDay2);
                for (i = 0; i != myMarketDay2.options.length; i++) {
                    if (myMarketDay2.options[i].value == dayVal) {
                        myMarketDay2.options[i].selected = true;
                        break
                    }
                }
            }
        };
        var dateUpdate = function() {
            var yearMonthVal = thisDatePickerManager.yearMonth.val();
            var dayVal = thisDatePickerManager.day.val();
            var date = parseDate(yearMonthVal, dayVal);
            var dateVal = $.datepicker.formatDate(fullDateFormatString, date);
            thisDatePickerManager.linkedDate.val(dateVal);
            if (this.name == 'ControlGroupSearchView$AvailabilitySearchInputSearchView$DropDownListMarketDay1' && this.tagName == 'SELECT') {
                var myMarketDay2 = document.getElementById('ControlGroupSearchView_AvailabilitySearchInputSearchView_DropDownListMarketDay2');
                for (i = 0; i != myMarketDay2.options.length; i++) {
                    if (myMarketDay2.options[i].value == dayVal) {
                        myMarketDay2.options[i].selected = true; break
                    }
                }
                var date2HiddenId = "date_picker_id_2"; dateHidden2 = $('#' + date2HiddenId); dateHidden2.val(dateVal);
            } 
        }; var createAllDayOptionArray = function() {
            var retArray = []; var optionIterator = 1; var option = {}; for (optionIterator = 1; optionIterator <= 31; optionIterator += 1) {
                option = {}; option.name = optionIterator; if (optionIterator <= 9) { option.code = '0' + optionIterator; }
                else { option.code = optionIterator; }
                retArray[optionIterator - 1] = option;
            }
            return retArray;
        }; var updateLinked = function(dateString) {
            var match = dateString.match(/\d{2}\/\d{2}\/\d{4}/); var date = new Date(); var yearMonthString = ''; if (match) {
                date = new Date(dateString); yearMonthString = $.datepicker.formatDate(yearMonthFormatString, date); thisDatePickerManager.yearMonth.val(yearMonthString); dayResizeAndSet(date); var dayVal = thisDatePickerManager.day.val(); var daysInMonth = getDaysInMonth(date); if (dayVal > daysInMonth) { dayVal = daysInMonth; }
                if (this.id == 'date_picker_id_1' && this._calId == '0') {
                    var myMarketMonth2 = document.getElementById('ControlGroupSearchView_AvailabilitySearchInputSearchView_DropDownListMarketMonth2'); for (i = 0; i != myMarketMonth2.options.length; i++) { if (myMarketMonth2.options[i].value == yearMonthString) { myMarketMonth2.options[i].selected = true; break } }
                    var myMarketDay2 = document.getElementById('ControlGroupSearchView_AvailabilitySearchInputSearchView_DropDownListMarketDay2'); dayResizeAndSet(date, myMarketDay2); for (i = 0; i != myMarketDay2.options.length; i++) { if (myMarketDay2.options[i].value == dayVal) { myMarketDay2.options[i].selected = true; break } }
                    var dateVal = $.datepicker.formatDate(fullDateFormatString, date); var date2HiddenId = "date_picker_id_2"; dateHidden2 = $('#' + date2HiddenId); dateHidden2.val(dateVal);
                } 
            } 
        }; thisDatePickerManager.setSettingsByObject = function(paramObject) { var propName = ''; for (propName in paramObject) { if (thisDatePickerManager.hasOwnProperty(propName)) { thisDatePickerManager[propName] = paramObject[propName]; } } }; thisDatePickerManager.setVars = function() { if (true === thisDatePickerManager.isAOS) { yearMonthDelimiter = '/'; yearMonthFormatString = 'm/yy'; validateYearMonthRegExp = new RegExp('\\d{1,2}\\/\\d{4}'); firstDateOption = 'eq(1)'; } }; var initFlight = function() { if (!thisDatePickerManager.isAOS) { dateUpdate(); } }; thisDatePickerManager.addEvents = function() {
            thisDatePickerManager.yearMonth.change(yearMonthUpdate); thisDatePickerManager.day.change(dateUpdate); var minDate = new Date(); var maxDate = new Date(); var setDayDate = new Date(); maxDate.setFullYear(maxDate.getFullYear() + 1); var yearMonthFirst = $('option:' + firstDateOption, thisDatePickerManager.yearMonth).val(); var yearMonthLast = $('option:last', thisDatePickerManager.yearMonth).val(); allDayOptionArray = createAllDayOptionArray(); var linkedDate = thisDatePickerManager.linkedDate; if (validateYearMonth(yearMonthFirst)) {
                minDate.setDate(minDate.getDate() - 1); if (thisDatePickerManager.isAOS) { setDayDate = new Date(thisDatePickerManager.linkedDate.val()); }
                else { setDayDate = getDate(thisDatePickerManager.yearMonth.val(), thisDatePickerManager.day.val()); }
                dayResizeAndSet(setDayDate);
            }
            if (validateYearMonth(yearMonthLast)) { maxDate = getDate(yearMonthLast, 1); var daysInMonth = getDaysInMonth(maxDate); maxDate = new Date(maxDate.getFullYear(), maxDate.getMonth(), daysInMonth); }
            var resource = SKYSALES.Util.getResource(); var dateCultureInfo = resource.dateCultureInfo; var datePickerSettings = SKYSALES.datepicker; initFlight(); var datePickerParams = { 'beforeShow': readLinked, 'onSelect': updateLinked, 'minDate': minDate, 'maxDate': maxDate, 'showOn': 'both', 'buttonImageOnly': true, 'buttonImage': 'images/CebuAir/calendaricon.gif', 'buttonText': 'Calendar', 'numberOfMonths': 1, 'mandatory': true, 'monthNames': dateCultureInfo.monthNames, 'monthNamesShort': dateCultureInfo.monthNamesShort, 'dayNames': dateCultureInfo.dayNames, 'dayNamesShort': dateCultureInfo.dayNamesShort, 'dayNamesMin': dateCultureInfo.dayNamesMin, 'closeText': datePickerSettings.closeText, 'prevText': datePickerSettings.prevText, 'nextText': datePickerSettings.nextText, 'currentText': datePickerSettings.currentText }; linkedDate.datepicker(datePickerParams);
        }; thisDatePickerManager.init = function(paramObject) { this.setSettingsByObject(paramObject); this.setVars(); this.addEvents(); };
    };
}
SKYSALES.initializeSkySalesForm = function() { document.SkySales = document.forms.SkySales; }; SKYSALES.getSkySalesForm = function() { var skySalesForm = $('SkySales').get(0); return skySalesForm; }; SKYSALES.Common = function() {
    var thisCommon = this; var countryInfo = null; thisCommon.allInputObjects = null; thisCommon.initializeCommon = function() { var hint = new SKYSALES.Hint(); var inputLabel = new SKYSALES.InputLabel(); thisCommon.addKeyDownEvents(); thisCommon.addSetAndEraseEvents(); thisCommon.setValues(); hint.addHintEvents(); inputLabel.formatInputLabel(); thisCommon.stripeTables(); }; thisCommon.setValues = function() { var setValue = function(index) { if ((this.jsvalue !== null) && (this.jsvalue !== undefined)) { this.value = this.jsvalue; } }; thisCommon.getAllInputObjects().each(setValue); }; thisCommon.stopSubmit = function() { $('form').unbind('submit', thisCommon.stopSubmit); return false; }; thisCommon.addKeyDownEvents = function() {
        var keyFunction = function(e) {
            if (e.keyCode === 13) { $('form').submit(thisCommon.stopSubmit); return false; }
            return true;
        }; $(':input').keydown(keyFunction);
    }; thisCommon.getAllInputObjects = function() {
        if (thisCommon.allInputObjects === null) { thisCommon.allInputObjects = $(':input'); }
        return thisCommon.allInputObjects;
    }; thisCommon.addSetAndEraseEvents = function() { var focusFunction = function() { thisCommon.eraseElement(this, this.requiredempty); }; var blurFunction = function() { thisCommon.setElement(this, this.requiredempty); $(this).change(); }; var eventFunction = function(index) { var input = $(this); if ((this.requiredempty !== null) && (this.requiredempty !== undefined)) { if (input.is(':text') && (input.is(':hidden') === false)) { input.focus(focusFunction); input.blur(blurFunction); } } }; thisCommon.getAllInputObjects().each(eventFunction); }; thisCommon.eraseElement = function(element, defaultValue) { if (element.value === defaultValue) { element.value = ""; } }; thisCommon.setElement = function(element, defaultValue) { if (element.value === "") { element.value = defaultValue; } }; thisCommon.getCountryInfo = function() {
        if (countryInfo === null) { countryInfo = window.countryInfo; }
        return countryInfo;
    }; thisCommon.setCountryInfo = function(arg) { countryInfo = arg; return thisCommon; }; thisCommon.isEmpty = function(element, defaultValue) {
        var val = null; var retVal = false; if ((element) && (defaultValue === undefined)) {
            if (element.requiredempty) { defaultValue = element.requiredempty; }
            else { defaultValue = ''; } 
        }
        val = SKYSALES.Common.getValue(element); if ((val === null) || (val === undefined) || (val.length === 0) || (val === defaultValue)) { retVal = true; }
        return retVal;
    }; thisCommon.stripeTables = function() { $(".stripeMe tr:even").addClass("alt"); return thisCommon; };
}; SKYSALES.Common.addEvent = function(obj, eventString, functionRef) { $(obj).bind(eventString, functionRef); }; SKYSALES.Common.getValue = function(e) {
    var val = null; if (e) { val = $(e).val(); return val; }
    return null;
}; SKYSALES.InputLabel = function() {
    var thisInputLabel = this; thisInputLabel.getInputLabelRequiredFlag = function() { return '*'; }; thisInputLabel.getInputLabelSuffix = function() { return ':'; }; thisInputLabel.formatInputLabel = function() {
        var requiredFlag = thisInputLabel.getInputLabelRequiredFlag(); var suffix = thisInputLabel.getInputLabelSuffix(); var eventFunction = function(index) {
            var label = $("label[@for=" + this.id + "]").eq(0); var labelText = $(label).text(); var inputType = ''; var required = null; if (labelText !== '') {
                inputType = $(this).attr("type"); if ((inputType !== 'checkbox') && (inputType !== 'radio') && labelText.indexOf(':') == -1) { labelText = labelText + suffix; }
                required = this.required; if (required === undefined) { required = null; }
                if (required === null) { required = this.getAttribute('required'); }
                if (required !== null) { required = required.toString().toLowerCase(); if (required === 'true' && labelText.indexOf('*') == -1) { labelText = requiredFlag + labelText; } }
                $(label).text(labelText);
            } 
        }; SKYSALES.common.getAllInputObjects().each(eventFunction);
    };
}; SKYSALES.Dhtml = function() {
    var thisDhtml = this; thisDhtml.getX = function(obj) {
        var pos = 0; if (obj.x) { pos += obj.x; }
        else if (obj.offsetParent) { while (obj.offsetParent) { pos += obj.offsetLeft; obj = obj.offsetParent; } }
        return pos;
    }; thisDhtml.getY = function(obj) {
        var pos = 0; if (obj.y) { pos += obj.y; }
        else if (obj) { while (obj) { pos += obj.offsetTop; obj = obj.offsetParent; } }
        return pos;
    }; return thisDhtml;
}; SKYSALES.Hint = function() {
    var thisHint = this; thisHint.addHintEvents = function() {
        var eventFunction = function(index) {
            if ((this.hint !== null) && (this.hint !== undefined)) {
                if (this.tagName && (this.tagName.toString().toLowerCase() === 'input')) { thisHint.addHintFocusEvents(this); }
                else { thisHint.addHintHoverEvents(this); } 
            } 
        }; SKYSALES.common.getAllInputObjects().each(eventFunction);
    }; thisHint.addHintFocusEvents = function(obj, hintText) { var focusFunction = function() { thisHint.showHint(obj, hintText); }; var blurFunction = function() { thisHint.hideHint(obj, hintText); }; if ($(obj).is(':hidden') === false) { $(obj).focus(focusFunction); $(obj).blur(blurFunction); } }; thisHint.addHintHoverEvents = function(obj, hintText) { var showFunction = function() { thisHint.showHint(obj, hintText); }; var hideFunction = function() { thisHint.hideHint(obj, hintText); }; $(obj).hover(showFunction, hideFunction); }; thisHint.getHintDivId = function() { return "cssHint"; }; thisHint.showHint = function(obj, hintHtml, xOffset, yOffset, referenceId) {
        var hintDivId = thisHint.getHintDivId(); var jQueryHintDiv = $('#' + hintDivId); var x = 0; var y = 0; var defaultXOffset = 0; var defaultYOffset = 0; if (xOffset === undefined) { xOffset = obj.hintxoffset; }
        if (yOffset === undefined) { yOffset = obj.hintyoffset; }
        if (referenceId === undefined) { referenceId = obj.hintReferenceid; }
        var referenceObject = $('#' + referenceId).get(0); var dhtml = new SKYSALES.Dhtml(); if (!referenceObject) { x = dhtml.getX(obj); y = dhtml.getY(obj); if (xOffset === undefined) { x += obj.offsetWidth + 100; } }
        else { x = dhtml.getX(referenceObject); y = dhtml.getY(referenceObject); if (xOffset === undefined) { x += referenceObject.offsetWidth + 100; } }
        if (hintHtml === undefined) { if (obj.hint !== undefined) { hintHtml = obj.hint; } }
        jQueryHintDiv.html(hintHtml); jQueryHintDiv.show(); xOffset = (xOffset !== undefined) ? xOffset : defaultXOffset; yOffset = (yOffset !== undefined) ? yOffset : defaultYOffset; var leftX = parseInt(xOffset, 10) + parseInt(x, 10); var leftY = parseInt(yOffset, 10) + parseInt(y, 10); jQueryHintDiv.css('left', leftX + 'px'); jQueryHintDiv.css('top', leftY + 'px');
    }; thisHint.hideHint = function(obj) { var hintDivId = thisHint.getHintDivId(); $('#' + hintDivId).hide(); };
}; SKYSALES.ValidationErrorReadAlong = function() {
    var thisReadAlong = this; thisReadAlong.objId = ''; thisReadAlong.obj = null; thisReadAlong.errorMessage = ''; thisReadAlong.isError = false; thisReadAlong.hasBeenFixed = false; thisReadAlong.hasValidationEvents = false; thisReadAlong.getValidationErrorHtml = function() { var validatonErrorHtml = '<div id="validationErrorContainerReadAlongList" style="width:99%;"><\/div>'; return validatonErrorHtml; }; thisReadAlong.getValidationErrorCloseId = function() { return 'validationErrorContainerReadAlongCloseButton'; }; thisReadAlong.getValidationErrorListId = function() { return 'validationErrorContainerReadAlongList'; }; thisReadAlong.getValidationErrorIFrameId = function() { return 'validationErrorContainerReadAlongIFrame'; }; thisReadAlong.getValidationErrorDivId = function() { return 'validationErrorContainerReadAlong'; }; thisReadAlong.getFixedClass = function() { return 'fixedValidationError'; }; thisReadAlong.addCloseEvent = function() { var closeId = thisReadAlong.getValidationErrorCloseId(); var closeFunction = function() { thisReadAlong.hide(); }; $('#' + closeId).click(closeFunction); }; thisReadAlong.addValidationErrorDiv = function() { $("#errorDiv").css('display', 'block'); $('#errorDiv').append(thisReadAlong.getValidationErrorHtml()); }; thisReadAlong.hide = function() { var iFrameId = thisReadAlong.getValidationErrorIFrameId(); var divId = thisReadAlong.getValidationErrorDivId(); $('#' + iFrameId).hide(); $('#' + divId).hide(); }; thisReadAlong.addFocusEvent = function(index) {
        var data = { obj: this }; var eventFunction = function(event) {
            var obj = event.data.obj; var hint = null; var readAlongDivObj = null; var readAlongDivWidth = 0; var readAlongDivHeight = 0; var x = 0; var y = 0; var dhtml = null; var iFrameObj = null; if (obj.isError === true) {
                hint = new SKYSALES.Hint(); hint.hideHint(); readAlongDivObj = $('#' + thisReadAlong.getValidationErrorDivId()); readAlongDivWidth = parseInt(readAlongDivObj.width(), 10) + 5; readAlongDivHeight = parseInt(readAlongDivObj.height(), 10) + 5; dhtml = new SKYSALES.Dhtml(); x = dhtml.getX(obj.obj); y = dhtml.getY(obj.obj); x = x + this.offsetWidth - 100; y = y - 280; if ($.browser.msie) { iFrameObj = $('#' + thisReadAlong.getValidationErrorIFrameId()); iFrameObj.css('position', 'absolute'); iFrameObj.show(); iFrameObj.width(readAlongDivWidth - 25); iFrameObj.height(readAlongDivHeight - 5); iFrameObj.css('left', x + 16); iFrameObj.css('top', y); }
                readAlongDivObj.css('left', x); readAlongDivObj.css('top', y); readAlongDivObj.css('position', 'absolute'); readAlongDivObj.show('slow'); return false;
            } 
        }; if ($(this.obj).is(':hidden') === false) { $(this.obj).bind("focus", data, eventFunction); } 
    }; thisReadAlong.addBlurEvent = function(index) {
        var data = { obj: this }; var eventFunction = function(event) {
            var obj = event.data.obj; var validateObj = new SKYSALES.Validate(null, '', '', null); validateObj.validateSingleElement(this); var errorMessage = validateObj.errors; var isFixed = false; var allFixed = true; if (validateObj.validationErrorArray.length > 0) { if (validateObj.validationErrorArray[0].isError === false) { isFixed = true; } }
            var listId = obj.getValidationErrorListId(); var listObj = $('#' + listId).find('li').eq(index); var fixedClass = obj.getFixedClass(); var fixedFunction = function() { if ((allFixed === true) && ($(this).attr("class").indexOf('hidden') === -1) && ($(this).attr("class").indexOf(fixedClass) === -1)) { allFixed = false; } }; if (isFixed === true) { obj.hasBeenFixed = true; listObj.addClass(fixedClass); allFixed = true; $('#' + listId).find('li').each(fixedFunction); if (allFixed === true) { thisReadAlong.hide(); } }
            else { obj.hasBeenFixed = false; listObj.removeClass(fixedClass); listObj.removeClass('hidden'); obj.isError = true; obj.errorMessage = errorMessage; listObj.text(errorMessage); }
            return false;
        }; $(this.obj).bind("blur", data, eventFunction);
    };
}; SKYSALES.errorsHeader = 'Please correct the following.\n\n'; SKYSALES.Validate = function(form, controlID, errorsHeader, regexElementIdFilter) {
    var thisValidate = this; if (errorsHeader === undefined) { errorsHeader = SKYSALES.errorsHeader; }
    thisValidate.form = form; thisValidate.namespace = controlID; thisValidate.errors = ''; thisValidate.validationErrorArray = []; thisValidate.setfocus = null; thisValidate.clickedObj = null; thisValidate.errorDisplayMethod = 'read_along'; thisValidate.errorsHeader = errorsHeader; thisValidate.namedErrors = []; thisValidate.dateRangeArray = []; if (regexElementIdFilter) { thisValidate.regexElementIdFilter = regexElementIdFilter; }
    thisValidate.requiredAttribute = 'required'; thisValidate.requiredEmptyAttribute = 'requiredempty'; thisValidate.validationTypeAttribute = 'validationtype'; thisValidate.regexAttribute = 'regex'; thisValidate.minLengthAttribute = 'minlength'; thisValidate.numericMinLengthAttribute = 'numericminlength'; thisValidate.maxLengthAttribute = 'maxlength'; thisValidate.numericMaxLengthAttribute = 'numericmaxlength'; thisValidate.minValueAttribute = 'minvalue'; thisValidate.maxValueAttribute = 'maxvalue'; thisValidate.equalsAttribute = 'equals'; thisValidate.dateRangeAttribute = 'daterange'; thisValidate.dateRange1HiddenIdAttribute = 'date1hiddenid'; thisValidate.dateRange2HiddenIdAttribute = 'date2hiddenid'; thisValidate.dateCheckAttribute = 'datecheck'; thisValidate.contactCheckAttribute = 'checkcontact'; thisValidate.checkINSAttribute = 'checkinsurance'; thisValidate.checkWWFAttribute = 'checkwwfee'; thisValidate.checkMERAttribute = 'checkmerchandise'; thisValidate.checkEnableTxtBoxAttribute = 'enabletxtbox'; thisValidate.checkFlightCombinationAttribute = 'checkflightcombination'; thisValidate.checkFlightAvailabiltyAttribute = 'checkflightavailabilty'; thisValidate.checkUMAttribute = 'checkum'; thisValidate.defaultErrorAttribute = 'error'; thisValidate.requiredErrorAttribute = 'requirederror'; thisValidate.validationTypeErrorAttribute = 'validationtypeerror'; thisValidate.regexErrorAttribute = 'regexerror'; thisValidate.minLengthErrorAttribute = 'minlengtherror'; thisValidate.maxLengthErrorAttribute = 'maxlengtherror'; thisValidate.minValueErrorAttribute = 'minvalueerror'; thisValidate.maxValueErrorAttribute = 'maxvalueerror'; thisValidate.equalsErrorAttribute = 'equalserror'; thisValidate.dateRangeErrorAttribute = 'daterangeerror'; thisValidate.dateEqualErrorAttribute = 'dateequalerror'; thisValidate.dateNoFlightsErrorAttribute = "datenoflightserror"; thisValidate.dateCheckErrorAttribute = 'datecheckerror'; thisValidate.dateCheckInfantErrorAttribute = 'infantdateerror'; thisValidate.nameCheckErrorAttribute = 'namecheckerror'; thisValidate.dateValhoursErrorAttribute = 'valhours'; thisValidate.checkUMErrorAttribute = 'checkumerror'; thisValidate.validatecheckInpaxerror = 'validatecheckinpaxerror'; thisValidate.validateSeatmaperror = 'validateseatmaperror'; thisValidate.defaultError = '{label} is invalid.'; thisValidate.defaultRequiredError = '{label} is required.'; thisValidate.defaultValidationTypeError = '{label} is invalid.'; thisValidate.defaultRegexError = '{label} is invalid.'; thisValidate.defaultMinLengthError = '{label} is too short in length.'; thisValidate.defaultMaxLengthError = '{label} is too long in length.'; thisValidate.defaultMinValueError = '{label} must be greater than {minValue}.'; thisValidate.defaultMaxValueError = '{label} must be less than {maxValue}.'; thisValidate.defaultEqualsError = '{label} is not equal to {equals}'; thisValidate.defaultNotEqualsError = '{label} cannot equal {equals}'; thisValidate.defaultSameNameError = 'Duplicate of another guest.'; thisValidate.defaultInvalidFlightCombination = 'Flight dates you\'ve chosen are invalid. Please select another date combination.'; thisValidate.defaultNoFlightFoundError = 'You must select another date or station.'; thisValidate.defaultcheckInpaxerror = 'At least one passenger must be checked in.'; thisValidate.defaultSeatmaperror = 'Passenger must select a seat.'; thisValidate.defaultValidationErrorClass = 'validationError'; thisValidate.defaultValidationErrorLabelClass = 'validationErrorLabel'; thisValidate.run = function() {
        var nodeArray = $(':input', SKYSALES.getSkySalesForm()).get(); var e = null; for (var i = 0; i < nodeArray.length; i += 1) { e = nodeArray[i]; thisValidate.checkBirthdate(e); if (!this.isExemptFromValidation(e)) { thisValidate.validateSingleElement(e); } }
        return thisValidate.outputErrors();
    }; thisValidate.runBySelector = function(selectorString) {
        var nodeArray = $(selectorString).find(':input').get(); var node = null; var i = 0; for (i = 0; i < nodeArray.length; i += 1) { node = nodeArray[i]; thisValidate.validateSingleElement(node); }
        return false;
    }; thisValidate.validateSingleElement = function(e) { $(e).removeClass(thisValidate.defaultValidationErrorClass); $("label[@for=" + e.id + "]").eq(0).removeClass(this.defaultValidationErrorLabelClass); var validationError = new SKYSALES.ValidationErrorReadAlong(); validationError.objId = e.id; validationError.obj = e; this.validationErrorArray[thisValidate.validationErrorArray.length] = validationError; this.validateRequired(e); var value = thisValidate.getValue(e); if ((thisValidate.errors.length < 1) && (value !== null) && (value !== "")) { thisValidate.validateType(e); thisValidate.validateRegex(e); thisValidate.validateMinLength(e); thisValidate.validateMaxLength(e); thisValidate.validateMinValue(e); thisValidate.validateMaxValue(e); thisValidate.validateEquals(e); thisValidate.validateInfant(e); thisValidate.validateName(e); thisValidate.validateDateRange(e); thisValidate.checkINS(e); thisValidate.checkWWF(e); thisValidate.checkMER(e); thisValidate.validateContact(e); thisValidate.validateSeatMap(e); thisValidate.enablePassTxtBox(e); thisValidate.checkFlightAvailabilty(e); thisValidate.validateDepartureTime(e); } }; thisValidate.enablePassTxtBox = function(e) { var aINS = e[thisValidate.checkEnableTxtBoxAttribute]; var txtbox = $("#div [@class^='medium'] :input"); if (aINS) { e.disabled = false; } }
    thisValidate.checkINS = function(e) {
        var aINS = e[thisValidate.checkINSAttribute]; var foundInsuranceSelected = false; var ins = $("#objIns ul li[@class^='insCheckBox'] :input"); if (aINS) {
            $(ins).each(function() { if ($(this).attr('checked') && !($(this).attr('disabled'))) { foundInsuranceSelected = true; } }); if (foundInsuranceSelected == true) {
                var insOpt = $("#totalIns p").find('input'); if ($(insOpt).attr('checked')) { return true; }
                else { thisValidate.setError(e, thisValidate.requiredErrorAttribute, thisValidate.defaultRequiredError); return false; } 
            } 
        }
        return true;
    }
    thisValidate.checkWWF = function(e) {
        var aWWF = e[thisValidate.checkWWFAttribute]; var foundInsuranceSelected = false; var WWF1 = $("tr td[@id^='wwfControlJourney1'] :input"); var WWF2 = $("tr td[@id^='wwfControlJourney2'] :input"); if (aWWF) {
            $(WWF1).each(function() { if ($(this).attr('checked') && !($(this).attr('disabled'))) { foundInsuranceSelected = true; } }); $(WWF2).each(function() { if ($(this).attr('checked') && !($(this).attr('disabled'))) { foundInsuranceSelected = true; } }); if (foundInsuranceSelected == true) {
                var WWFOpt = $("#WWFagree p").find('input'); if ($(WWFOpt).attr('checked')) { return true; }
                else { thisValidate.setError(e, thisValidate.requiredErrorAttribute, thisValidate.defaultRequiredError); return false; } 
            } 
        }
        return true;
    }
    thisValidate.checkMER = function(e) {
        var aMER = e[thisValidate.checkMERAttribute]; var foundInsuranceSelected = false; var MER1 = $("tr[@id^='airbControl'] :input"); var MER2 = $("tr[@id^='ckitControl'] :input"); if (aMER) {
            $(MER1).each(function() {
                if ($(this).attr('checked'))
                { foundInsuranceSelected = true; } 
            }); $(MER2).each(function() {
                if ($(this).attr('checked'))
                { foundInsuranceSelected = true; } 
            }); if (foundInsuranceSelected == true) {
                var MEROpt = $("#MERagree p").find('input'); if ($(MEROpt).attr('checked'))
                { return true; }
                else
                { thisValidate.setError(e, thisValidate.requiredErrorAttribute, thisValidate.defaultRequiredError); return false; } 
            } 
        }
        return true;
    }
    thisValidate.outputErrors = function() {
        var errorDisplayMethod = this.errorDisplayMethod.toString().toLowerCase(); var errorHtml = ''; var errorArray = []; var i = 0; var showDefaultErrorMethod = true; if (this.errors) {
            errorArray = thisValidate.errors.split('\n'); errorHtml += '<div style="float:left;padding:5px;"><img src="images/CebuAir/error icon.gif"/></div><ul class="validationErrorList" >'; for (i = 0; i < errorArray.length; i += 1) { if (errorArray[i] !== '') { errorHtml += '<li class="validationErrorListItem" >' + errorArray[i] + '<\/li>'; } }
            errorHtml += '<\/ul><br style="clear:both;"/><\/div>'; if (errorDisplayMethod.indexOf('read_along') > -1) { thisValidate.outputErrorsReadAlong(errorHtml); showDefaultErrorMethod = false; }
            if (errorDisplayMethod.indexOf('alert') > -1) { alert(thisValidate.errorsHeader + thisValidate.errors); }
            if (showDefaultErrorMethod === true) { alert(thisValidate.errorsHeader + thisValidate.errors); }
            if (thisValidate.setfocus) { if ($(thisValidate.setfocus).is(':hidden') === false) { thisValidate.setfocus.blur(); thisValidate.setfocus.focus(); } }
            return false;
        }
        else { return true; } 
    }; thisValidate.outputErrorsReadAlong = function(errorHtml) {
        var i = 0; var errorHtmlLocal = ''; var validationError = null; var validateObject = this; var addErrorEventFunction = function(index) { this.hasValidationEvents = true; this.addFocusEvent(index); this.addBlurEvent(index); }; validateObject.validationErrorReadAlong = new SKYSALES.ValidationErrorReadAlong(); validateObject.readAlongDivId = $('#' + this.validationErrorReadAlong.getValidationErrorDivId()).attr('id'); if (validateObject.readAlongDivId === undefined) { validateObject.validationErrorReadAlong.addValidationErrorDiv(); validateObject.validationErrorReadAlong.addCloseEvent(); }
        errorHtmlLocal += '<div style="float:left;border:1px solid #D3985E;width:99%;padding:5px;margin-bottom:5px;"><div style="float:left;padding:5px;width:40px;"><img src="images/CebuAir/error icon.gif"/></div><ul class="validationErrorList" style="float:left;margin:0px;padding:15px 0;width:90%;">'; for (i = 0; i < validateObject.validationErrorArray.length; i += 1) {
            validationError = this.validationErrorArray[i]; if (validationError.isError === true) { errorHtmlLocal += '<li class="validationErrorListItem">' + validationError.errorMessage + '<\/li>'; }
            else { errorHtmlLocal += '<li class="validationErrorListItem hidden" >' + validationError.errorMessage + '<\/li>'; } 
        }
        $('#' + validateObject.validationErrorReadAlong.getValidationErrorListId()).html(errorHtmlLocal); $(validateObject.validationErrorArray).each(addErrorEventFunction);
    }; thisValidate.checkFocus = function(e) { if (!thisValidate.setfocus) { thisValidate.setfocus = e; } }; thisValidate.setError = function(e, errorAttribute, defaultTypeError, focusOnError) {
        var nameStr = ''; var error = ''; var dollarOne = ''; var i = 0; var validationError = null; if (e.type === 'radio') {
            nameStr = e.getAttribute('name'); if (nameStr.length > 0) {
                if (thisValidate.namedErrors[nameStr] !== undefined) { return; }
                thisValidate.namedErrors[nameStr] = nameStr;
            } 
        }
        error = e[errorAttribute]; if (!error) {
            if (e[thisValidate.defaultErrorAttribute]) { error = e[thisValidate.defaultErrorAttribute]; }
            else if (defaultTypeError) { error = defaultTypeError; }
            else { error = thisValidate.defaultError; } 
        }
        var results = error.match(/\{\s*(\w+)\s*\}/g); if (results) { for (i = 0; i < results.length; i += 1) { dollarOne = results[i].replace(/\{\s*(\w+)\s*\}/, '$1'); error = error.replace(/\{\s*\w+\s*\}/, thisValidate.cleanAttributeForErrorDisplay(e, dollarOne)); } }
        $(e).addClass(this.defaultValidationErrorClass); $("label[@for=" + e.id + "]").eq(0).addClass(thisValidate.defaultValidationErrorLabelClass); this.errors += error + '\n'; var errorObjId = e.id; for (i = 0; i < thisValidate.validationErrorArray.length; i += 1) { validationError = thisValidate.validationErrorArray[i]; if (validationError.objId === errorObjId) { validationError.errorMessage = error; validationError.isError = true; break; } }
        var setFocusOnControl = focusOnError == false ? false : true; if (setFocusOnControl == true) { this.checkFocus(e); } 
    }; thisValidate.cleanAttributeForErrorDisplay = function(e, attributeName) {
        var inputLabelObj = null; var requiredString = ''; if (attributeName === undefined) { attributeName = ''; }
        attributeName = attributeName.toLowerCase(); var attribute = ""; if (attributeName === 'label') { attribute = $("label[@for=" + e.id + "]").eq(0).text(); inputLabelObj = new SKYSALES.InputLabel(); requiredString = inputLabelObj.getInputLabelRequiredFlag(); attribute = attribute.replace(requiredString, ''); }
        if (!attribute) { attribute = e.id; }
        if (!attribute) { return attributeName; }
        if (attributeName.match(/^(minvalue|maxvalue)$/i)) { return attribute.replace(/[^\d.,]/g, ''); }
        return attribute;
    }; thisValidate.validateRequired = function(e) {
        var requiredAttribute = thisValidate.requiredAttribute; var requiredEmptyAttribute = thisValidate.requiredEmptyAttribute; var required = e[requiredAttribute]; var requiredEmptyString = e[requiredEmptyAttribute]; var value = null; var checkOpenJaw = document.getElementById("ControlGroupSearchView_AvailabilitySearchInputSearchView_OpenJaw"); var origin2 = document.getElementById("ControlGroupSearchView_AvailabilitySearchInputSearchVieworiginStation2"); var destination2 = document.getElementById("ControlGroupSearchView_AvailabilitySearchInputSearchViewdestinationStation2"); thisValidate.radioGroupHash = {}; var radioName = ''; var isRadioGroupChecked = false; if (required !== undefined) {
            required = required.toString().toLowerCase(); if (requiredEmptyString) { requiredEmptyString = requiredEmptyString.toString().toLowerCase(); }
            if (required === 'true') {
                value = thisValidate.getValue(e); if ((e.type === 'checkbox') && (e.checked === false)) { value = ''; }
                else if (e.type === 'radio') {
                    radioName = e.getAttribute('name'); if (thisValidate.radioGroupHash[radioName] === undefined) { thisValidate.radioGroupHash[radioName] = $("input[@name='" + radioName + "']"); }
                    isRadioGroupChecked = thisValidate.radioGroupHash[radioName].is(':checked'); if (!isRadioGroupChecked) { value = ''; } 
                }
                if ((value === undefined) || (value === null) || (value === '') || (value.toLowerCase() === requiredEmptyString)) {
                    if ((origin2 != null && origin2["id"] == e["id"]) || (destination2 != null && destination2["id"] == e["id"])) { if (checkOpenJaw["checked"]) { thisValidate.setError(e, thisValidate.requiredErrorAttribute, thisValidate.defaultRequiredError); } }
                    else { thisValidate.setError(e, thisValidate.requiredErrorAttribute, thisValidate.defaultRequiredError); } 
                } 
            } 
        } 
    }; thisValidate.validateType = function(e) {
        var type = e[this.validationTypeAttribute]; var value = this.getValue(e); if ((type) && (value !== null)) {
            type = type.toLowerCase(); if ((type === 'address') && (!value.match(thisValidate.stringPattern))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'alphanumeric') && (!value.match(thisValidate.alphaNumericPattern))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'amount') && (!thisValidate.validateAmount(value))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'country') && (!value.match(thisValidate.stringPattern))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'email') && (!value.match(thisValidate.emailPattern))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'mod10') && (!thisValidate.validateMod10(value))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'name') && (!value.match(thisValidate.stringPattern))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'numeric') && (!thisValidate.validateNumeric(value))) { thisValidate.setValidateTypeError(e); }
            else if ((type.indexOf('date') === 0) && (!thisValidate.validateDate(e, type, value))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'state') && (!value.match(thisValidate.stringPattern))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'string') && (!value.match(thisValidate.stringPattern))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'uppercasestring') && (!value.match(thisValidate.upperCaseStringPattern))) { thisValidate.setValidateTypeError(e); }
            else if ((type === 'zip') && (!value.match(thisValidate.stringPattern))) { thisValidate.setValidateTypeError(e); } 
        } 
    }; thisValidate.validateRegex = function(e) { var regex = e[thisValidate.regexAttribute]; var value = thisValidate.getValue(e); if ((value !== null) && (regex) && (!value.match(regex))) { this.setError(e, thisValidate.regexErrorAttribute, thisValidate.defaultRegexError); } }; thisValidate.validateMinLength = function(e) {
        var length = e[thisValidate.minLengthAttribute]; var numericLength = e[thisValidate.numericMinLengthAttribute]; var value = this.getValue(e); if ((0 < length) && (value !== null) && (value.length < length)) { thisValidate.setError(e, thisValidate.minLengthErrorAttribute, thisValidate.defaultMinLengthError); }
        else if ((0 < numericLength) && (0 < value.length) && (value.replace(thisValidate.numericStripper, '').length < numericLength)) { thisValidate.setError(e, thisValidate.minLengthErrorAttribute, thisValidate.defaultMinLengthError); } 
    }; thisValidate.validateMaxLength = function(e) {
        var length = e[thisValidate.maxLengthAttribute]; var numericLength = e[thisValidate.numericMaxLengthAttribute]; var value = this.getValue(e); if ((0 < length) && (value !== null) && (length < value.length)) { thisValidate.setError(e, thisValidate.maxLengthErrorAttribute, thisValidate.defaultMaxLengthError); }
        else if ((0 < numericLength) && (0 < value.length) && (numericLength < value.replace(thisValidate.numericStripper, '').length)) { thisValidate.setError(e, thisValidate.maxLengthErrorAttribute, thisValidate.defaultMaxLengthError); } 
    }; thisValidate.validateMinValue = function(e) {
        var min = e[thisValidate.minValueAttribute]; var value = thisValidate.getValue(e); if ((value !== null) && (min !== undefined) && (0 < min.length)) {
            if ((5 < min.length) && (min.substring(0, 5) === '>=')) { if (value < parseFloat(min.substring(5, min.length))) { thisValidate.setError(e, thisValidate.minValueErrorAttribute, thisValidate.defaultMinValueError); } }
            else if ((4 < min.length) && (min.substring(0, 4) === '>')) { if (value <= parseFloat(min.substring(4, min.length))) { thisValidate.setError(e, thisValidate.minValueErrorAttribute, thisValidate.defaultMinValueError); } }
            else if (value < parseFloat(min)) { thisValidate.setError(e, thisValidate.minValueErrorAttribute, thisValidate.defaultMinValueError); } 
        } 
    }; thisValidate.validateMaxValue = function(e) {
        var max = e[this.maxValueAttribute]; var value = this.getValue(e); if ((value !== null) && (max !== undefined) && (0 < max.length)) {
            if ((5 < max.length) && (max.substring(0, 5) === '<=')) { if (value > parseFloat(max.substring(5, max.length))) { thisValidate.setError(e, thisValidate.maxValueErrorAttribute, thisValidate.defaultMaxValueError); } }
            else if ((4 < max.length) && (max.substring(0, 4) === '<')) { if (value >= parseFloat(max.substring(4, max.length))) { thisValidate.setError(e, thisValidate.maxValueErrorAttribute, thisValidate.defaultMaxValueError); } }
            else if (parseFloat(value) > max) { thisValidate.setError(e, thisValidate.maxValueErrorAttribute, thisValidate.defaultMaxValueError); } 
        } 
    }; thisValidate.validateSeatMap = function validateSeatMap(e) { thisID = e.id; if (thisID.match("ControlGroupUnitMapView_UnitMapViewControl_CheckBoxAgreement") !== null) { aInput = document.getElementsByTagName('input'); for (var i = 0; (input = aInput[i]); i++) { if (input.getAttribute('type') == 'text') { if (input.value.length > 0) { var checkboxid = "ControlGroupUnitMapView_UnitMapViewControl_CheckBoxAgreement"; if (document.getElementById(checkboxid).checked == false) { thisValidate.setError(e, thisValidate.requiredErrorAttribute, thisValidate.defaultRequiredError); break; } } } } } }; thisValidate.checkBirthdate = function checkBirthdate(e) {
        thisID = e.id; if (thisID.match("BirthDate")) {
            if (e["description"].match("Senior")) { e["required"] = "true"; }
            else if (e["description"].match("Child") && $("#marketCheck").find('li.marketJourney').text().match("HongKong")) { e["required"] = "true"; } 
        } 
    }
    thisValidate.checkAsterisk = function checkAsterisk(e) {
        thisID = e.id; if (thisID.match("CONTROLGROUPGUEST")) {
            if (e["description"].match("Senior")) { e["required"] = "true"; }
            else if (e["description"].match("Child") && $("#marketCheck").find('li.marketJourney').text().match("HongKong")) { e["required"] = "true"; }
            if (e["required"] = true) { $("#requiredBirthdate").text() = "XXXX"; } 
        } 
    }
    thisValidate.validateName = function validateName(e) {
        var nameCheck = e[thisValidate.nameCheckAttribute]; var value = thisValidate.getValue(e); isError = false; thisID = e.id; if (thisID.match("CONTROLGROUPGUEST_PassengerInputViewGuestView_TextBoxFirstName") !== null) {
            currentID = thisID.substr(thisID.lastIndexOf("_") + 1); strfirstName = "TextBoxFirstName_"; strlastName = "TextBoxLastName_"; var strID = "CONTROLGROUPGUEST_PassengerInputViewGuestView_"; var currentfirstNameID = strID + strfirstName + currentID; var currentlastNameID = strID + strlastName + currentID; var currentFullName = document.getElementById(currentfirstNameID).value + " " + document.getElementById(currentlastNameID).value; counter = parseInt(currentID) + 1; var comparefirstNameID = strID + strfirstName + counter; var comparelastNameID = strID + strlastName + counter; var comparefirstName = document.getElementById(comparefirstNameID); var comparelastName = document.getElementById(comparelastNameID); while (comparefirstName !== null && comparelastName !== null) {
                var compareFullName = comparefirstName.value + " " + comparelastName.value; if (counter !== currentID) { if (currentFullName == compareFullName) { isError = true; } }
                counter++; comparefirstNameID = strID + strfirstName + counter; comparelastNameID = strID + strlastName + counter; comparefirstName = document.getElementById(comparefirstNameID); comparelastName = document.getElementById(comparefirstNameID);
            }
            infantCtr = 0; counter = parseInt(currentID) + 1; var infantCompareFirstId = strID + strfirstName + infantCtr + "_" + infantCtr; var infantCompareLastId = strID + strlastName + infantCtr + "_" + infantCtr; var infantCompareFirst = document.getElementById(infantCompareFirstId); var infantCompareLast = document.getElementById(infantCompareLastId); while (infantCompareFirst !== null && infantCompareLast !== null) {
                var infantFullName = infantCompareFirst.value + " " + infantCompareLast.value; if (currentFullName == infantFullName) { isError = true; }
                infantCtr++; infantCompareFirstId = strID + strfirstName + infantCtr + "_" + infantCtr; infantCompareLastId = strID + strlastName + infantCtr + "_" + infantCtr; infantCompareFirst = document.getElementById(infantCompareFirstId); infantCompareLast = document.getElementById(infantCompareLastId);
            }
            if (isError) { thisValidate.setError(e, thisValidate.nameCheckErrorAttribute, thisValidate.defaultSameNameError); } 
        } 
    }; thisValidate.validateContact = function validateContact(e) { var value = thisValidate.getValue(e); var contactcheck = e[thisValidate.contactCheckAttribute]; checkID = e["id"]; string1 = checkID.substr(0, checkID.lastIndexOf("TextBox")) + "TextBox"; if (contactcheck !== undefined) { if (checkID.match("Country") !== null) { string2 = checkID.substr(checkID.lastIndexOf("Country"), checkID.length); string2 = string2.replace(/Country/, ""); var hidden = document.getElementById(string1 + string2); if (hidden.value !== "" || hidden.value !== null) { if (value == null || value == "") { thisValidate.setError(e, thisValidate.requiredErrorAttribute, thisValidate.defaultRequiredError); } } } } }
    thisValidate.validateInfant = function validateInfant(e) {
        var dateCheck = e[thisValidate.dateCheckAttribute]; var value = thisValidate.getValue(e); thisID = e.id; if (thisID.match("CONTROLGROUPGUEST_PassengerInputViewGuestView_DropDownListBirthDate") !== null) {
            var description = ""
            description = document.getElementById(thisID).attributes.getNamedItem('description').nodeValue; var checkType = description.substr(0, description.indexOf(" ", 0)); day = document.getElementById(thisID.replace(/DropDownListBirthDateYear/, 'DropDownListBirthDateDay')).value; month = document.getElementById(thisID.replace(/DropDownListBirthDateYear/, 'DropDownListBirthDateMonth')).value; year = document.getElementById(thisID).value; var myDate = new Date($("#deptBirthCompare").text()); var myDateRet = new Date($("#deptRetBirthCompare").text()); var two = new Date($("#deptBirthCompare").text()); var myDateRetCopy = new Date($("#deptRetBirthCompare").text()); var myDate2 = new Date(); var myToday = new Date(); myDate2.setFullYear(year, month - 1, day); if (checkType == "Infant" && dateCheck !== undefined) {
                myDate.setFullYear(myDate.getFullYear() - 2); myDateRet.setFullYear(myDateRet.getFullYear() - 2); myDate2.setHours(00, 00, 00, 00); two.setHours(two.getHours() + 384); var dateNow = new Date(); dateNow.setHours(00, 00, 00, 00); if (myDate2 > dateNow)
                { thisValidate.setError(e, thisValidate.dateCheckInfantErrorAttribute, thisValidate.defaultEqualsError); }
//                else {
//                    if (myDate2 <= myDate || myDate2 <= myDateRet) { thisValidate.setError(e, thisValidate.dateCheckInfantErrorAttribute, thisValidate.defaultEqualsError); }
//                    else if (myDate2.getFullYear() == myToday.getFullYear()) { var three = myDate; three.setFullYear(three.getFullYear() + 2); three.setDate(three.getDate() - 16); if (myDate2 > three) { thisValidate.setError(e, thisValidate.dateCheckInfantErrorAttribute, thisValidate.defaultEqualsError); } } 
//                } 
            } else if (checkType == "Child" && dateCheck !== undefined) {
                myDate.setFullYear(myDate.getFullYear() - 12); myDateRet.setFullYear(myDateRet.getFullYear() - 12); myDateRetCopy.setFullYear(myDateRetCopy.getFullYear() - 2); two.setFullYear(two.getFullYear() - 2); myDate2.setHours(00, 00, 00, 00); if (myDateRet !== undefined) { if (myDate2 > myDateRetCopy || myDate2 < myDateRet) { thisValidate.setError(e, thisValidate.dateCheckErrorAttribute, thisValidate.defaultEqualsError); } }
                else { if (myDate2 > two || myDate2 < myDate) { thisValidate.setError(e, thisValidate.dateCheckErrorAttribute, thisValidate.defaultEqualsError); } } 
            } else if (checkType == "Adult" && dateCheck !== undefined) {
                myDate.setFullYear(myDate.getFullYear() - 12); myDateRet.setFullYear(myDateRet.getFullYear() - 12); myDate2.setHours(00, 00, 00, 00); if (myDateRet !== undefined) { if (myDate2 > myDateRet) { thisValidate.setError(e, thisValidate.dateCheckErrorAttribute, thisValidate.defaultEqualsError); } }
                else { if (myDate2 > myDate) { thisValidate.setError(e, thisValidate.dateCheckErrorAttribute, thisValidate.defaultEqualsError); } } 
            } else if (checkType == "Senior" && dateCheck !== undefined) {
                myDate.setFullYear(myDate.getFullYear() - 60); myDateRet.setFullYear(myDateRet.getFullYear() - 60); myDate2.setHours(00, 00, 00, 00); if (myDateRet !== undefined) { if (myDate2 > myDateRet) { thisValidate.setError(e, thisValidate.dateCheckErrorAttribute, thisValidate.defaultEqualsError); } }
                else { if (myDate2 > myDate) { thisValidate.setError(e, thisValidate.dateCheckErrorAttribute, thisValidate.defaultEqualsError); } } 
            } 
        } 
    }; thisValidate.validateEquals = function validateEquals(e) {
        var equal = e[thisValidate.equalsAttribute]; var value = thisValidate.getValue(e); emailAdd = document.getElementById('CONTROLGROUPGUEST_GuestContactInputView_TextBoxEmailAddress'); if (e.id == 'CONTROLGROUPGUEST_GuestContactInputView_TextBoxConfirmEmail') { if (value !== emailAdd.value) { thisValidate.setError(e, thisValidate.equalsErrorAttribute, thisValidate.defaultEqualsError); } }
        else {
            if ((value !== null) && (equal !== undefined) && (0 < equal.length)) {
                if ((2 < equal.length) && (equal.substring(0, 2) === '!=')) { if (value === equal.substring(2, equal.length)) { thisValidate.setError(e, thisValidate.equalsErrorAttribute, thisValidate.defaultEqualsError); } }
                else if ((2 < equal.length) && (equal.substring(0, 2) === '==')) { if (value !== equal.substring(2, equal.length)) { thisValidate.setError(e, thisValidate.equalsErrorAttribute, thisValidate.defaultEqualsError); } }
                else if (equal.charAt(0) === '=') { if (value !== equal.substring(1, equal.length)) { thisValidate.setError(e, thisValidate.equalsErrorAttribute, thisValidate.defaultEqualsError); } }
                else if (value !== equal) { thisValidate.setError(e, thisValidate.equalsErrorAttribute, thisValidate.defaultEqualsError); } 
            } 
        } 
    }; thisValidate.validateDepartureTime = function validateDepartureTime(e) {
        var checkFlight = e[thisValidate.checkFlightCombinationAttribute]; if (checkFlight == 'true') {
            var table = $("#selectMainBody table[@id='availabilityTable']"); ("tr td[@class^='fareCol']"); var keys = []; var marketOneId = null; var marketTwoId = null; $("#selectMainBody table[@id='availabilityTable']").each(function() {
                table.find("td[@class^='fareCol']").each(function() {
                    var td = $(this); var radioId = td.find(":radio[@name$='market1'][@checked]").attr("id"); if (radioId) { marketOneId = radioId; }
                    radioId = td.find(":radio[@name$='market2'][@checked]").attr("id"); if (radioId) { marketTwoId = radioId; } 
                });
            }); var marketOneValue = null; var marketTwoValue = null; if (marketOneId != null && marketOneId != undefined) { marketOneValue = document.getElementById(marketOneId).value; }
            if (marketTwoId != null && marketTwoId != undefined) { marketTwoValue = document.getElementById(marketTwoId).value; }
            if ((marketOneValue != undefined && marketOneValue != '' && marketOneValue != null) && (marketTwoValue != undefined && marketTwoValue != '' && marketTwoValue != null)) {
                var charIndex = marketOneValue.indexOf("|") + 1; var arrStreamValue = marketOneValue.substring(charIndex).split("^"); var mkt1DateStream = ""; if (arrStreamValue.length > 1) { charIndex = arrStreamValue[1].indexOf("~~") + 2; mkt1DateStream = arrStreamValue[1].substring(charIndex); }
                else { charIndex = arrStreamValue[0].indexOf("~~") + 2; mkt1DateStream = arrStreamValue[0].substring(charIndex); }
                var arrMkt1Dates = mkt1DateStream.split("~"); var mkt1DateValue = new Date(arrMkt1Dates[3] + " GMT"); arrStreamValue = null; charIndex = marketTwoValue.indexOf("|") + 1; arrStreamValue = marketTwoValue.substring(charIndex).split("^"); var mkt2DateStream = ""; if (arrStreamValue.length > 1) { charIndex = arrStreamValue[1].indexOf("~~") + 2; mkt2DateStream = arrStreamValue[1].substring(charIndex); }
                else { charIndex = arrStreamValue[0].indexOf("~~") + 2; mkt2DateStream = arrStreamValue[0].substring(charIndex); }
                var arrMkt2Dates = mkt2DateStream.split("~"); var mkt2DateValue = new Date(arrMkt2Dates[1] + " GMT")
                if (mkt1DateValue.getUTCMonth() == mkt2DateValue.getUTCMonth() && mkt1DateValue.getUTCDate() == mkt2DateValue.getUTCDate() && mkt1DateValue.getUTCFullYear() == mkt2DateValue.getUTCFullYear()) {
                    var mkt1DateUTCHour = mkt1DateValue.getUTCHours(); var mkt1DateUTCMinutes = mkt1DateValue.getUTCMinutes(); var mkt2DateUTCHour = mkt2DateValue.getUTCHours(); var mkt2DateUTCMinutes = mkt2DateValue.getUTCMinutes(); var minTime = 2; if (((mkt2DateUTCHour - mkt1DateUTCHour) < minTime) || ((mkt2DateUTCHour - mkt1DateUTCHour) == minTime && (mkt1DateUTCMinutes > mkt2DateUTCMinutes))) {
                        thisValidate.setError(e, '', thisValidate.defaultInvalidFlightCombination, false)
                        scrollTo(0, 0);
                    } 
                } 
            } 
        } 
    }; thisValidate.checkFlightAvailabilty = function checkFlightAvailabilty(e) {
        var checkAvailability = e[thisValidate.checkFlightAvailabiltyAttribute]; if (checkAvailability == 'true') {
            var markets = $("#selectMainBody table[@id='availabilityTable']"); var table = $("#selectMainBody table[@id='availabilityTable']"); ("tr td[@class^='fareCol']"); var marketOneId = null; var marketTwoId = null; $("#selectMainBody table[@id='availabilityTable']").each(function() {
                table.find("td[@class^='fareCol']").each(function() {
                    var td = $(this); var radioId = td.find(":radio[@name$='market1'][@checked]").attr("id"); if (radioId) { marketOneId = radioId; }
                    radioId = td.find(":radio[@name$='market2'][@checked]").attr("id"); if (radioId) { marketTwoId = radioId; } 
                });
            }); if (markets.length >= 1 && marketOneId == null) { thisValidate.setError(e, '', thisValidate.defaultNoFlightFoundError) }
            else if (markets.length > 1 && marketTwoId == null) { thisValidate.setError(e, '', thisValidate.defaultNoFlightFoundError) } 
        } 
    }; var checkDateRangeExists = function(dateHidden2) { var parent = dateHidden2.parent(); var parent2 = parent.parent(); var noDateRangeIE = parent.is(':hidden'); var noDateRangeNonIE = parent2.is(':hidden'); var retVal = !(noDateRangeIE || noDateRangeNonIE); return retVal; }; thisValidate.checkIfValidateDateRangeNeeded = function(e) {
        var date = e[thisValidate.dateRangeAttribute]; var date1HiddenId = e[thisValidate.dateRange1HiddenIdAttribute]; var date2HiddenId = e[thisValidate.dateRange2HiddenIdAttribute]; var idLastChar = ''; var idSuffix = ''; var id = e.id; var startValidate = false; var dateRangeExists = false; var dateHidden1 = null; var dateHidden2 = null; if ((date !== undefined) && (0 < date.length)) {
            idLastChar = id.charAt(id.length - 1); if (this.validateNumeric(idLastChar)) { idSuffix = idLastChar; }
            if (('1' === idSuffix) || ('' === idSuffix)) {
                dateHidden2 = $('#' + date2HiddenId); dateRangeExists = checkDateRangeExists(dateHidden2); if (dateRangeExists) { startValidate = true; dateHidden1 = $('#' + date1HiddenId); thisValidate.dateRangeArray[0] = dateHidden1.val(); thisValidate.dateRangeArray[1] = dateHidden2.val(); }
                else { startValidate = true; dateHidden1 = $('#' + date1HiddenId); thisValidate.dateRangeArray[0] = dateHidden1.val(); } 
            } 
        }
        return startValidate;
    }; thisValidate.validateDateRange = function(e) {
        var marketDate = null; var datesInOrder = false; var valhours = e.valhours; var startValidate = thisValidate.checkIfValidateDateRangeNeeded(e); if (startValidate) {
            marketDate = new SKYSALES.Class.MarketDate(); if (this.dateRangeArray[1] !== undefined) { datesInOrder = marketDate.datesInOrder(this.dateRangeArray); if (!datesInOrder) { this.setError(e, this.dateRangeErrorAttribute, this.defaultError); return; } }
            if (valhours !== '0') { datesInOrder = marketDate.datesIsEqual(this.dateRangeArray, valhours); if (!datesInOrder) { this.setError(e, this.dateEqualErrorAttribute, this.defaultError); return; } }
            datesInOrder = marketDate.dateNoFlights(this.dateRangeArray); if (!datesInOrder) { this.setError(e, this.dateNoFlightsErrorAttribute, this.defaultError); return; } 
        } 
    }; thisValidate.isExemptFromValidation = function(e) {
        if (e.id.indexOf(this.namespace) !== 0) { return true; }
        if (this.regexElementIdFilter && (!e.id.match(this.regexElementIdFilter))) { return true; }
        return false;
    }; thisValidate.setValidateTypeError = function(e) { this.setError(e, this.validationTypeErrorAttribute, this.defaultValidationTypeError); }; thisValidate.validateAmount = function(amount) {
        if ((!amount.match(this.amountPattern)) || (amount === 0)) { return false; }
        return true;
    }; thisValidate.validateDate = function(e, type, value) {
        var lowerCaseType = ''; var today = new Date(); if (type) { lowerCaseType = type.toLowerCase(); }
        if ((lowerCaseType === 'dateyear') && ((value < today.getYear()) || (!value.match(thisValidate.dateYearPattern)))) { return false; }
        else if ((lowerCaseType === 'datemonth') && (!value.match(thisValidate.dateMonthPattern))) { return false; }
        else if ((lowerCaseType === 'dateday') && (!value.match(thisValidate.DateDayPattern))) { return false; }
        return true;
    }; thisValidate.validateMod10 = function(cardNumber) {
        var ccCheckRegExp = /\D/; var cardNumbersOnly = cardNumber.replace(/ /g, ""); var numberProduct; var checkSumTotal = 0; var productDigitCounter = 0; var digitCounter = 0; if (!ccCheckRegExp.test(cardNumbersOnly)) {
            while (cardNumbersOnly.length < 16) { cardNumbersOnly = '0' + cardNumbersOnly; }
            for (digitCounter = cardNumbersOnly.length - 1; 0 <= digitCounter; digitCounter -= 2) { checkSumTotal += parseInt(cardNumbersOnly.charAt(digitCounter), 10); numberProduct = String((cardNumbersOnly.charAt(digitCounter - 1) * 2)); for (productDigitCounter = 0; productDigitCounter < numberProduct.length; productDigitCounter += 1) { checkSumTotal += parseInt(numberProduct.charAt(productDigitCounter), 10); } }
            return (checkSumTotal % 10 === 0);
        }
        return false;
    }; thisValidate.validateNumeric = function(number) {
        number = number.replace(/\s/g, ''); if (!number.match(thisValidate.numericPattern)) { return false; }
        return true;
    }; thisValidate.getValue = function(e) { return SKYSALES.Common.getValue(e); }; thisValidate.stringPattern = /^.+$/; thisValidate.upperCaseStringPattern = /^[A-Z]([A-Z|\s])*$/; thisValidate.numericPattern = /^\d+$/; thisValidate.numericStripper = /\D/g; thisValidate.alphaNumericPattern = /^\w+$/; thisValidate.amountPattern = /^(\d+((\.|,|\s|\xA0)\d+)*)$/; thisValidate.dateYearPattern = /^\d{4}$/; thisValidate.dateMonthPattern = /^\d{2}$/; thisValidate.dateDayPattern = /^\d{2}$/; thisValidate.emailPattern = /^\w+([\.\-\']?\w+)*@\w+([\.\-\']?\w+)*(\.\w{1,8})$/;
}; var validateBySelector = function(selectorString) {
    var validate = null; var clickedObj = null; if (selectorString !== undefined) { validate = new SKYSALES.Validate(null, '', SKYSALES.errorsHeader, null); validate.clickedObj = clickedObj; validate.runBySelector(selectorString); return validate.outputErrors(); }
    return true;
}; var validate = function(controlID, elementName, filter) {
    var clickedObj = null; var validate = null; var e = null; if (document.getElementById && document.createTextNode) {
        if (controlID.getAttribute) { clickedObj = controlID; controlID = controlID.getAttribute("id").replace(/_\w+$/, ""); }
        validate = new SKYSALES.Validate(SKYSALES.getSkySalesForm(), controlID + '_', SKYSALES.errorsHeader, filter); validate.clickedObj = clickedObj; if (elementName) {
            e = elementName; if (!elementName.getAttribute) { e = document.getElementById(controlID + "_" + elementName); }
            validate.validateSingleElement(e); return validate.outputErrors();
        }
        return validate.run();
    }
    return true;
}; var preventDoubleClick = function() { return true; }; var events = []; var register = function(eventName, functionName) {
    if (events[eventName] === undefined) { events[eventName] = []; }
    events[eventName][events[eventName].length] = functionName;
}; var raise = function(eventName, eventArgs) {
    var ix = 0; if (events[eventName] !== undefined) { for (ix = 0; ix < events[eventName].length; ix += 1) { if (eval(events[eventName][ix] + "(eventArgs)") === false) { return false; } } }
    return true;
}; var WindowInitialize = function() { var originalOnLoad = window.onload; var windowLoadFunction = function() { raise('WindowLoad', {}); if (originalOnLoad) { originalOnLoad(); } }; $(window).ready(windowLoadFunction); }; SKYSALES.Util.displayPopUpConverter = function() {
    var url = 'CurrencyConverter.aspx'; var converterWindow = window.converterWindow; if (!window.converterWindow || converterWindow.closed) { converterWindow = window.open(url, 'converter', 'width=360,height=220,toolbar=0,status=0,location=0,menubar=0,scrollbars=0,resizable=0'); }
    else { converterWindow.open(url, 'converter', 'width=360,height=220,toolbar=0,status=0,location=0,menubar=0,scrollbars=0,resizable=0'); if ($(converterWindow).is(':hidden') === false) { converterWindow.focus(); } } 
}; var hideShow = function(hideControl, depControl) {
    var controlHide = hideControl; var controlDepend = depControl; if (document.getElementById && document.getElementById(hideControl)) {
        if (document.getElementById(controlDepend).checked === true) { document.getElementById(controlHide).style.display = "inline"; }
        else { document.getElementById(controlHide).style.display = "none"; } 
    } 
}; var jsLoadedCommon = true; SKYSALES.toggleAtAGlanceEvent = function() { $(this).next().toggle(); }; SKYSALES.toggleAtAGlance = function() { $("div.atAGlanceDivHeader").click(SKYSALES.toggleAtAGlanceEvent); }; SKYSALES.initializeTime = function() {
    var i = 0; var timeOptions = ""; for (i = 0; i < 23; i += 1) { timeOptions += "<option value=" + i + ">" + i + "</option>"; }
    if (timeOptions !== "") { $("select.Time").append(timeOptions); } 
}; $("a.animateMe").animate({ height: 'toggle', opacity: 'toggle' }, "slow"); SKYSALES.aosAvailabilityShow = function() { $(this).parent().find('div.hideShow').show('slow'); return false; }; SKYSALES.aosAvailabilityHide = function() { $(this).parent().parent('.hideShow').hide('slow'); return false; }; SKYSALES.dropDownMenuEvent = function() { $("div.slideDownUp").toggle('fast'); return false; }; SKYSALES.faqHideShow = function() { $(this).parent('dt').next('.accordianSlideContent').slideToggle("slow"); }; SKYSALES.equipHideShow = function() { $('div#moreSearchOptions').slideToggle("slow"); return false; }; SKYSALES.initializeAosAvailability = function() { $('.hideShow').hide(); $('a.showContent').click(SKYSALES.aosAvailabilityShow); $('a.hideContent').click(SKYSALES.aosAvailabilityHide); $('a.toggleSlideContent').click(SKYSALES.dropDownMenuEvent); $('a.accordian').click(SKYSALES.faqHideShow); $('a.showEquipOpt').click(SKYSALES.equipHideShow); $('a.hideEquipOpt').click(SKYSALES.equipHideShow); }; SKYSALES.initializeMetaObjects = function() { $.metaobjects({ clean: false }); }; SKYSALES.common = new SKYSALES.Common(); function formatCurrency(value) {
    var cents = 0; value = value.toString(); if (isNaN(value)) { value = '0'; }
    if (value.indexOf('.') > -1) { cents = value.substring(value.indexOf('.') + 1, value.length); value = value * 100; }
    cents = value % 100; if (cents > 0) { value = Math.floor(value / 100).toString(); }
    if (cents < 10) { cents = '0' + cents; }
    for (var i = 0; i < Math.floor((value.length - (1 + i)) / 3); i += 1) { value = value.substring(0, value.length - (4 * i + 3)) + ',' + value.substring(value.length - (4 * i + 3)); }
    return (value + '.' + cents);
}
var validateUM = function(e) {
    var ddlAdult = $("#mainContent p span[@class='title'] select[@id$='DropDownListPassengerType_ADT']"); var ddlChild = $("#mainContent p span[@class='title'] select[@id$='DropDownListPassengerType_CHD']"); var adultVal = 0; var childVal = 0; $(ddlAdult).each(function() { adultVal = $(this).val(); }); $(ddlChild).each(function() { childVal = $(this).val(); }); var clickedObj = null; var validate = null; var controlID = null; var filter = null; if (e.getAttribute) { clickedObj = e; controlID = e.getAttribute("id").replace(/_\w+$/, ""); }
    validate = new SKYSALES.Validate(SKYSALES.getSkySalesForm(), controlID + '_', SKYSALES.errorsHeader, filter); validate.clickedObj = clickedObj; var validationError = new SKYSALES.ValidationErrorReadAlong(); validationError.objId = e.id; validationError.obj = e; validationError.isError = true; validate.validationErrorArray[validate.validationErrorArray.length] = validationError; validate.setfocus = false; if (childVal > 0 && adultVal == 0) { validate.setError(e, 'checkumerror', validate.defaultError, false); validate.outputErrors(); } 
}; var validateCheckinPax = function(e) {
    var CheckInSelected = false; var noSeatAssigned = false; var table = $("table[@id='checkinPassengerTable']"); var cbPax = null; var CheckPaxId = null; var SeatPaxId = null; $("table[@id='checkinPassengerTable']").each(function() {
        var td = $(this); table.find("td").each(function() {
            SeatPaxId = $(this).siblings(".seatnum").find("a").text(); CheckPaxId = $(this).find(":checkbox[@name*='CheckBoxPaxJourney'][@checked]").attr("id"); if (cbPax == null) { cbPax = $(this).find(":checkbox[@name*='CheckBoxPaxJourney']").attr("id"); }
            if (CheckPaxId) { CheckInSelected = true; if (SeatPaxId != '') { noSeatAssigned = true; } } 
        }); var clickedObj = null; var validate = null; var controlID = null; var filter = null; validate = new SKYSALES.Validate(SKYSALES.getSkySalesForm(), controlID + '_', SKYSALES.errorsHeader, filter); validate.clickedObj = clickedObj; var validationError = new SKYSALES.ValidationErrorReadAlong(); validationError.objId = cbPax.id; validationError.obj = cbPax; validationError.isError = true; validate.validationErrorArray[validate.validationErrorArray.length] = validationError; validate.setfocus = false; if (CheckInSelected == false || noSeatAssigned == true) {
            if (CheckInSelected == false) { validate.setError(cbPax, validate.validatecheckInpaxerror, validate.defaultcheckInpaxerror, false); }
            else
                validate.setError(cbPax, validate.validateSeatmaperror, validate.defaultSeatmaperror, false); validate.outputErrors();
        } 
    }); return CheckInSelected && !noSeatAssigned;
}
SKYSALES.Util.sendAspFormFields = function() {
    var clearAllValidity = null; var eventTargetElement = window.document.getElementById('eventTarget'); var eventArgumentElement = window.document.getElementById('eventArgument'); var viewStateElement = window.document.getElementById('viewState'); var theForm = window.theForm; if (!theForm.onsubmit || (theForm.onsubmit() !== false)) { eventTargetElement.name = '__EVENTTARGET'; eventArgumentElement.name = '__EVENTARGUMENT'; viewStateElement.name = '__VIEWSTATE'; if (theForm.checkValidity) { clearAllValidity = function() { $(this).removeAttr("required"); }; SKYSALES.common.getAllInputObjects().each(clearAllValidity); } }
    return true;
}; SKYSALES.Util.initStripeTable = function() { $('.hotelResult').hide(); var stripeMeInputHandler = function() { $('.stripeMe tr').removeClass("over"); $(this).parent().parent().addClass("over"); }; $('.stripeMe input').click(stripeMeInputHandler); }; SKYSALES.Util.ready = function() { $('form').submit(SKYSALES.Util.sendAspFormFields); SKYSALES.initializeMetaObjects(); SKYSALES.common.initializeCommon(); SKYSALES.Util.initObjects(); SKYSALES.initializeSkySalesForm(); SKYSALES.toggleAtAGlance(); SKYSALES.Util.initStripeTable(); SKYSALES.initializeAosAvailability(); }; $(document).ready(SKYSALES.Util.ready); SKYSALES.Util.populateSelectOriDestSattion = function(paramObj) {
    var selectedItem = paramObj.selectedItem || null; var objectArray = paramObj.objectArray || null; var selectBox = paramObj.selectBox || null; var showCode = paramObj.showCode || false; var clearOptions = paramObj.clearOptions || false; var text = ''; var value = ''; var selectBoxObj = null; var obj = null; var prop = ''; if (selectBox) {
        selectBoxObj = selectBox.get(0); thisID = selectBoxObj.id; if (selectBoxObj && selectBoxObj.options) {
            if (clearOptions) { selectBoxObj.options.length = 0; }
            else {
                if (!selectBoxObj.originalOptionLength) { selectBoxObj.originalOptionLength = selectBoxObj.options.length; }
                selectBoxObj.options.length = selectBoxObj.originalOptionLength; var toDD = document.getElementById(thisID); while (toDD.options.length > 1) { toDD.remove(1); }
                $("#" + thisID + " optgroup").remove(); for (var a = 0; a < document.getElementsByTagName("optgroup").length; a++) { if (document.getElementsByTagName("optgroup")[a].parentNode.name == thisID) { var childOne = document.getElementsByTagName("optgroup")[a]; toDD.removeChild(childOne); a = 0; } } 
            }
            if (objectArray) {
                var modoriginId = thisID.substring(thisID.length, thisID.length - 14); var modestinationId = thisID.substring(thisID.length, thisID.length - 19); var radioVisible = document.getElementById('ControlGroupSearchView_AvailabilitySearchInputSearchView_OpenJaw'); if (modoriginId == "originStation1" || (modoriginId == "originStation2" && radioVisible !== null)) { selectBoxObj.options[0] = new window.Option('Origin', '', true, false); if (modoriginId == "originStation1") { selectBoxObj.required = "true"; selectBoxObj.requirederror = "Origin is a required field."; } else if (radioVisible.checked == true) { selectBoxObj.required = "true"; selectBoxObj.requirederror = "return Origin is a required field."; } }
                else if (modoriginId == "originStation2" && radioVisible === null) { selectBoxObj.options[0] = new window.Option('Origin', '', true, false); }
                else if (modestinationId == "destinationStation1" || (modestinationId == "destinationStation2" && radioVisible !== null)) { selectBoxObj.options[0] = new window.Option('Destination', '', true, false); if (modestinationId == "destinationStation1") { selectBoxObj.required = "true"; selectBoxObj.requirederror = "Destination is a required field."; } else if (radioVisible.checked == true) { selectBoxObj.required = "true"; selectBoxObj.requirederror = "return Destination is a required field.fff"; } } else if (modestinationId == "destinationStation2" && radioVisible === null) { selectBoxObj.options[0] = new window.Option('Destination', '', true, false); }
                var countryArray = new Array(); var fromArray = new Array(); SKYSALES.Util.ParseCitiesAndCountries(objectArray, fromArray, countryArray); fromArray = fromArray.sort(); countryArray = countryArray.sort(); SKYSALES.Util.ConstructDropDown(countryArray, selectBoxObj, fromArray); if (selectedItem !== null) { selectBox.val(selectedItem); } 
            } 
        } 
    } 
}; SKYSALES.Util.ParseCitiesAndCountries = function(objectArray, cityArray, countryArray) {
    for (prop in objectArray) {
        if (objectArray.hasOwnProperty(prop)) {
            obj = objectArray[prop]; var city = obj.name; var country = obj.countryCode; var code = obj.code; if (country == 'PH') { country = "Philippines"; }
            else if (country == 'BN') { country = "Brunei Darussalam"; }
            else if (country == 'CN') { country = "China"; }
            else if (country == 'HK') { country = "Hongkong"; }
            else if (country == 'ID') { country = "Indonesia"; }
            else if (country == 'JP') { country = "Japan"; }
            else if (country == 'MO') { country = "Macau"; }
            else if (country == 'MY') { country = "Malaysia"; }
            else if (country == 'AE') { country = "Qatar"; }
            else if (country == 'SG') { country = "Singapore"; }
            else if (country == 'KR') { country = "South Korea"; }
            else if (country == 'TW') { country = "Taiwan"; }
            else if (country == 'TH') { country = "Thailand"; }
            else if (country == 'VN') { country = "Vietnam"; }
            var countryIndex = SKYSALES.Util.IndexOfItem(countryArray, country); if (countryIndex == -1) { countryIndex = countryArray.length; countryArray[countryArray.length] = [country, countryArray.length]; }
            if (SKYSALES.Util.IndexOfItem(cityArray, city) == -1) { cityArray[cityArray.length] = [city, countryIndex, code]; } 
        } 
    } 
}; SKYSALES.Util.IndexOfItem = function(arr, item) {
    if (!arr || arr.length == 0) return -1; var bMultiDimArr = false; if (arr[0][0] != null) bMultiDimArr = true; for (var i = 0; i < arr.length; i++) {
        if (bMultiDimArr && arr[i][0] == item) { return i; }
        else if (arr[i] == item) { return i; } 
    }
    return -1;
}; SKYSALES.Util.ConstructDropDown = function(countryArray, dropdown, citiesArray) {
    for (var h = 0; h < countryArray.length; h++) {
        var cityGroup = document.createElement('optgroup'); cityGroup.label = countryArray[h][0]; cityGroup.className = 'countryGroup'; for (var i = 0; i < citiesArray.length; i++) { if (countryArray[h][1] == citiesArray[i][1]) { var cityOption = document.createElement("option"); document.getElementById(dropdown.id).options.add(cityOption); cityOption.value = citiesArray[i][2]; cityOption.innerHTML = citiesArray[i][0]; cityOption.className = "cities"; cityGroup.appendChild(cityOption); } }
        var FirstCountryToShow = null; if (countryArray[h][0] == FirstCountryToShow && h != 0) { dropdown.insertBefore(cityGroup, dropdown.childNodes[2]); }
        else { dropdown.appendChild(cityGroup); } 
    } 
}; SKYSALES.Util.populateSelectByOject = function(paramObj, objSelectBox) {
    var selectedItem = paramObj.selectedItem || null; var objectArray = paramObj.objectArray || null; var selectBox = objSelectBox || null; var showCode = paramObj.showCode || false; var clearOptions = paramObj.clearOptions || false; var text = ''; var value = ''; var selectBoxObj = null; var obj = null; var prop = ''; if (selectBox) {
        selectBoxObj = selectBox; if (selectBoxObj && selectBoxObj.options) {
            if (clearOptions) { selectBoxObj.options.length = 0; }
            else {
                if (!selectBoxObj.originalOptionLength) { selectBoxObj.originalOptionLength = selectBoxObj.options.length; }
                selectBoxObj.options.length = selectBoxObj.originalOptionLength;
            }
            if (objectArray) {
                for (prop in objectArray) {
                    if (objectArray.hasOwnProperty(prop)) {
                        obj = objectArray[prop]; if (showCode) { text = obj.name + ' (' + obj.code + ')'; }
                        else { text = obj.name; }
                        value = obj.code; selectBoxObj.options[selectBoxObj.options.length] = new window.Option(text, value, false, false);
                    } 
                } 
            } 
        } 
    } 
}; function displayPopup(url, title, width, height) {
    if (!window.popupWindow || popupWindow.closed) { popupWindow = window.open(url, title, 'width=' + width + ', height=' + height + ',toolbar=0,status=0,location=0,menubar=0,scrollbars=1,resizable=1'); }
    else { popupWindow.open(url, title, 'width=' + width + ', height=' + height + ',toolbar=0,status=0,location=0,menubar=0,scrollbars=1,resizable=1'); popupWindow.focus(); } 
}
if (SKYSALES.Class.AvailabilityInput === undefined) {
    SKYSALES.Class.AvailabilityInput = function() {
        var thisAvailabilityInput = this; thisAvailabilityInput.detailsLinks = null; thisAvailabilityInput.journeyInfoArray = []; thisAvailabilityInput.journeyInfo = new SKYSALES.Class.JourneyInfo(); thisAvailabilityInput.bookingSummary = {}; thisAvailabilityInput.getPriceItineraryInfo = function() { if (undefined !== window.taxAndFeeInclusiveDisplayDataRequestHandler) { var markets = $("#selectMainBody #availabilityTable tr td[@class^='fareCol'] :radio[@checked]"); var keys = []; $(markets).each(function(i) { keys[i] = $(this).val(); }); window.taxAndFeeInclusiveDisplayDataRequestHandler(keys, markets.length); } }; thisAvailabilityInput.showPreselectedFares = function(keyArray) { for (var keyIndex = 0; keyIndex < keyArray.length; keyIndex += 1) { if (keyArray[keyIndex] !== null) { $("#" + keyArray[keyIndex]).click(); } } }; thisAvailabilityInput.addCommas = function(nStr) {
            nStr += ''; x = nStr.split('.'); x1 = x[0]; x2 = x.length > 1 ? x[1] + '00' : '0000'; var d1 = x2.substr(0, 2); var d2 = x2.substr(2, x2.length); x2 = String(Math.round(d1 + "." + d2)); x2 = x2.length > 1 ? '.' + x2 : '.0' + x2; var rgx = /(\d+)(\d{3})/; while (rgx.test(x1)) { x1 = x1.replace(rgx, '$1' + ',' + '$2'); }
            return x1 + x2;
        }
        thisAvailabilityInput.updateBookingSummary = function(keyArray, showTotal) {
            var title = $(".sidebar .contents .section ul"); title.children().remove(); if (thisAvailabilityInput.bookingSummary.marketCount > 1) {
                if (thisAvailabilityInput.bookingSummary.arrvStation == thisAvailabilityInput.bookingSummary.deptStationReturn) {
                    if (thisAvailabilityInput.bookingSummary.deptStation != thisAvailabilityInput.bookingSummary.arrvStationReturn) {
                        title.append("<li>Open Jaw</li>"); title.append("<br/><li>" +
thisAvailabilityInput.bookingSummary.deptStation + " - " +
thisAvailabilityInput.bookingSummary.arrvStation + " - " +
thisAvailabilityInput.bookingSummary.deptStationReturn + " - " +
thisAvailabilityInput.bookingSummary.arrvStationReturn + "</li>");
                    }
                    else {
                        title.append("<li>Round Trip</li>"); title.append("<br/><li>" +
thisAvailabilityInput.bookingSummary.deptStation + " - " +
thisAvailabilityInput.bookingSummary.arrvStation + " - " +
thisAvailabilityInput.bookingSummary.deptStation + "</li>");
                    } 
                }
                else if (thisAvailabilityInput.bookingSummary.deptStation == thisAvailabilityInput.bookingSummary.arrvStationReturn) {
                    if (thisAvailabilityInput.bookingSummary.arrvStation != thisAvailabilityInput.bookingSummary.deptStationReturn) {
                        title.append("<li>Open Jaw</li>"); title.append("<br/><li>" +
thisAvailabilityInput.bookingSummary.deptStation + " - " +
thisAvailabilityInput.bookingSummary.arrvStation + " - " +
thisAvailabilityInput.bookingSummary.deptStationReturn + " - " +
thisAvailabilityInput.bookingSummary.arrvStationReturn + "</li>");
                    }
                    else {
                        title.append("<li>Round Trip</li>"); title.append("<br/><li>" +
thisAvailabilityInput.bookingSummary.deptStation + " - " +
thisAvailabilityInput.bookingSummary.arrvStation + " - " +
thisAvailabilityInput.bookingSummary.deptStation + "</li>");
                    } 
                } 
            }
            else {
                title.append("<li>One Way</li>"); title.append("<br/><li>" +
thisAvailabilityInput.bookingSummary.deptStation + " to " +
thisAvailabilityInput.bookingSummary.arrvStation + "</li>");
            }
            title.append("<br/><li>" +
thisAvailabilityInput.bookingSummary.adultPaxCount + " ADULT / " +
thisAvailabilityInput.bookingSummary.childPaxCount + " CHILD / " +
thisAvailabilityInput.bookingSummary.infantPaxCount + " INFANT </li>"); if (thisAvailabilityInput.bookingSummary.isAnonymous == "False" && (thisAvailabilityInput.bookingSummary.vatExPaxCount != 0 || thisAvailabilityInput.bookingSummary.pwdPaxCount != 0 || thisAvailabilityInput.bookingSummary.seniorPaxCount != 0)) {
                var _paxType = "<br/><li>"; if (thisAvailabilityInput.bookingSummary.pwdPaxCount != 0) { _paxType += thisAvailabilityInput.bookingSummary.pwdPaxCount + " PWD / "; }
                if (thisAvailabilityInput.bookingSummary.seniorPaxCount != 0) { _paxType += thisAvailabilityInput.bookingSummary.seniorPaxCount + " SENIOR / "; }
                title.append(_paxType.substr(0, _paxType.length - 2)); title.append("</li>");
            }
            var selectedFareDiv = null; var total = 0; var baseFare = 0; for (var keyIndex = 0; keyIndex < keyArray.length; keyIndex += 1) {
                if (keyArray[keyIndex] !== null && keyArray[keyIndex] !== '') {
                    selectedFareDiv = $("#" + keyArray[keyIndex]).parent(); var adultPrice = selectedFareDiv.siblings(".farePrices").find("span[@id^='ADT']").text(); var infantPrice = selectedFareDiv.siblings(".farePrices").find("span[@id^='INF']").text(); if (adultPrice != undefined && adultPrice != null && adultPrice != '') { adultPrice = adultPrice.replace(/[^0-9.]/gi, ""); baseFare = parseFloat(adultPrice); }
                    total = total + (baseFare * parseInt(thisAvailabilityInput.bookingSummary.adultPaxCount))
                    total = total + (baseFare * parseInt(thisAvailabilityInput.bookingSummary.childPaxCount))
                    total = total + (baseFare * parseInt(thisAvailabilityInput.bookingSummary.seniorPaxCount))
                    total = total + (baseFare * parseInt(thisAvailabilityInput.bookingSummary.pwdPaxCount))
                    total = total + (baseFare * parseInt(thisAvailabilityInput.bookingSummary.vatExPaxCount))
                    total = thisAvailabilityInput.getTotalAmountDiscounted(keyArray[keyIndex], baseFare, total); if (infantPrice != undefined && infantPrice != null && infantPrice != '') { infantPrice = infantPrice.replace(/[^0-9.]/gi, ""); baseFare = parseFloat(infantPrice); total = total + (baseFare * parseInt(thisAvailabilityInput.bookingSummary.infantPaxCount)) } 
                } 
            }
            var bagTotal = $("#totalBGAmount"); if (bagTotal !== undefined) { total += parseFloat(thisAvailabilityInput.addCommas($("#totalBGAmount").text())); }
            if (showTotal) { $(".contents .section .total #bookingSummaryTotal").text(thisAvailabilityInput.addCommas(total).toString()); } 
        }; thisAvailabilityInput.getTotalAmountDiscounted = function(controlId, baseFare, total) {
            var discountedFare = 0; var paxCount = 0; var rbValue = document.getElementById(controlId).value; var arrValues = rbValue.split("~", 3); if (thisAvailabilityInput.bookingSummary.isPaxDiscounted == 'True' && arrValues[1] == "T") {
                with (thisAvailabilityInput.bookingSummary) { paxCount = parseInt(adultPaxCount) + parseInt(childPaxCount) + parseInt(seniorPaxCount) + parseInt(pwdPaxCount) + parseInt(vatExPaxCount); paxCount = parseInt(paxCount / 2); }
                discountedFare = total - (paxCount * baseFare); return discountedFare;
            }
            return total;
        }; thisAvailabilityInput.Open = function(divRadioButton) { var getvalue = divRadioButton.showcheckinreminder; if (getvalue == "True") { $("#noteMidnight").css('display', 'block'); $("#fade").css('display', 'block'); } }
        thisAvailabilityInput.Close = function() { $("#noteMidnightClose").click(function() { $("#noteMidnight").css('display', 'none'); $("#fade").css('display', 'none'); }); }
        thisAvailabilityInput.onRadioButtonFareSelect = function() {
            var table = $("#selectMainBody table[@id='availabilityTable']"); ("tr td[@class^='fareCol']"); var keys = []; var marketOneId = null; var marketTwoId = null; $("#selectMainBody table[@id='availabilityTable']").each(function() {
                table.find("td[@class^='fareCol']").each(function() {
                    var td = $(this); var radioId = td.find(":radio[@name$='market1'][@checked]").attr("id"); if (radioId) { marketOneId = radioId; }
                    radioId = td.find(":radio[@name$='market2'][@checked]").attr("id"); if (radioId) { marketTwoId = radioId; } 
                });
            }); keys[0] = marketOneId; keys[1] = marketTwoId; thisAvailabilityInput.updateBookingSummary(keys, true);
        }
        thisAvailabilityInput.addUpdateBookingSummaryEvent = function() { $("#selectMainBody table[@id='availabilityTable']").each(function() { var table = $(this); table.find("td[@class^='fareCol'] :radio").each(function() { $(this).click(function() { thisAvailabilityInput.onRadioButtonFareSelect(); thisAvailabilityInput.Open(this); }); }); }); }; thisAvailabilityInput.showLowestFare = function(keyArray) {
            for (var keyIndex = 0; keyIndex < keyArray.length; keyIndex += 1) {
                if (keyArray[keyIndex] !== null) {
                    selectedFareDiv = $("#" + keyArray[keyIndex]).parent(); var adultPrice = selectedFareDiv.siblings(".farePrices").find("span[@id^='ADT']").text(); var lowestFare = "N/A"; if (adultPrice != undefined && adultPrice != null && adultPrice != '') { lowestFare = adultPrice; }
                    $('#selectMainBody ' + '#Market' + (keyIndex + 1) + 'BestPrice').text("BEST PRICE " + lowestFare.toString());
                } 
            } 
        }; thisAvailabilityInput.setPreselectedFares = function() {
            var fareColumnCells = $("#selectMainBody #availabilityTable tr td[@class^='fareCol']"); var markets = fareColumnCells.find(":radio[@checked]").length; if (markets === 0) { $("#taxAndFeeInclusiveDivBody").remove(); }
            else if (markets === 1) { $("#taxesAndFeesInclusiveDisplay_2").hide(); }
            var marketOneLowPrice = -1; var marketTwoLowPrice = -1; var marketOneID = ""; var marketTwoID = ""; var price = -1; $("#selectMainBody table[@id='availabilityTable']").each(function() { var table = $(this); table.find("td[@class^='fareCol']").each(function() { var td = $(this); var radioId = td.find(":radio[@name$='market1']").attr("id"); if (radioId) { price = $.trim(td.find("span[@id^='ADT']").text()); var tempPrice = price.replace(/[^0-9.]/gi, ""); price = parseFloat(tempPrice); if (!isNaN(price)) { if (price < marketOneLowPrice || marketOneLowPrice < 0) { marketOneLowPrice = price; marketOneID = radioId; } } } }); }); $("#selectMainBody table[@id='availabilityTable']").each(function() { var table = $(this); table.find("td[@class^='fareCol']").each(function() { var td = $(this); var radioId = td.find(":radio[@name$='market2']").attr("id"); if (radioId) { price = $.trim(td.find("span[@id^='ADT']").text()); var tempPrice = price.replace(/[^0-9.]/gi, ""); price = parseFloat(tempPrice); if (!isNaN(price)) { if (price < marketTwoLowPrice || marketTwoLowPrice < 0) { marketTwoLowPrice = price; marketTwoID = radioId; } } } }); }); var keyArray = []; keyArray[0] = marketOneID; keyArray[1] = marketTwoID; thisAvailabilityInput.updateBookingSummary(keyArray, false); thisAvailabilityInput.showLowestFare(keyArray);
        }; thisAvailabilityInput.addGetPriceItineraryInfoEvents = function() { $("#selectMainBody #availabilityTable tr td[@class^='fareCol'] :radio").each(function() { $(this).click(function() { thisAvailabilityInput.getPriceItineraryInfo(); }); }); }; thisAvailabilityInput.ajaxEquipmentProperties = function() { }; thisAvailabilityInput.addEquipmentPropertiesAjaxEvent = function() { $(this).click(thisAvailabilityInput.ajaxEquipmentProperties); }; thisAvailabilityInput.addEquipmentPropertiesAjaxEvents = function() { thisAvailabilityInput.detailsLinks.each(thisAvailabilityInput.addEquipmentPropertiesAjaxEvent); }; thisAvailabilityInput.addEvents = function() { thisAvailabilityInput.addGetPriceItineraryInfoEvents(); thisAvailabilityInput.addEquipmentPropertiesAjaxEvents(); }; thisAvailabilityInput.setVars = function() { thisAvailabilityInput.detailsLinks = $('.showContent'); }; thisAvailabilityInput.initJourneyInfoContainers = function() { var i = 0; var journeyInfoList = this.journeyInfoList; for (i = 0; i < journeyInfoList.length; i += 1) { thisAvailabilityInput.journeyInfo.init(journeyInfoList[i]); thisAvailabilityInput.journeyInfoArray[thisAvailabilityInput.journeyInfoArray.length] = thisAvailabilityInput.journeyInfo; } }; thisAvailabilityInput.initFlightInfoDisplay = function() { $("#selectMainBody table[@id='availabilityTable']").each(function() { $(this).find(".flightInfoLink").each(function() { var link = $(this); link.hover(function() { $(this).siblings("#flightDetails").css({ 'display': 'block' }); }, function() { $(this).siblings("#flightDetails").css({ 'display': 'none' }); }); }); }); }; thisAvailabilityInput.init = function() { thisAvailabilityInput.Close(); thisAvailabilityInput.initJourneyInfoContainers(); thisAvailabilityInput.initFlightInfoDisplay(); thisAvailabilityInput.setPreselectedFares(); thisAvailabilityInput.addUpdateBookingSummaryEvent(); if (undefined !== window.taxAndFeeInclusiveDisplayDataRequestHandler) { thisAvailabilityInput.setPreselectedFares(); thisAvailabilityInput.setVars(); thisAvailabilityInput.addEvents(); } };
    };
}
if (SKYSALES.Class.JourneyInfo === undefined) {
    SKYSALES.Class.JourneyInfo = function() {
        var thisJourneyInfo = this; thisJourneyInfo.equipmentInfoUri = 'EquipmentPropertiesDisplayAjax-resource.aspx'; thisJourneyInfo.key = ''; thisJourneyInfo.journeyContainerId = ""; thisJourneyInfo.activateJourneyId = ""; thisJourneyInfo.activateJourney = null; thisJourneyInfo.deactivateJourneyId = ""; thisJourneyInfo.deactivateJourney = null; thisJourneyInfo.journeyContainer = null; thisJourneyInfo.legInfoArray = []; thisJourneyInfo.clientName = 'EquipmentPropertiesDisplayControlAjax'; thisJourneyInfo.init = function(paramObject) { this.setSettingsByObject(paramObject); this.setVars(); this.addEvents(); }; thisJourneyInfo.setVars = function() { thisJourneyInfo.journeyContainer = $('#' + thisJourneyInfo.journeyContainerId); thisJourneyInfo.activateJourney = $('#' + thisJourneyInfo.activateJourneyId); thisJourneyInfo.deactivateJourney = $('#' + thisJourneyInfo.deactivateJourneyId); }; thisJourneyInfo.addEvents = function() { thisJourneyInfo.activateJourney.click(thisJourneyInfo.show); thisJourneyInfo.deactivateJourney.click(thisJourneyInfo.hide); }; thisJourneyInfo.setSettingsByObject = function(jsonObject) { var propName = ''; for (propName in jsonObject) { if (thisJourneyInfo.hasOwnProperty(propName)) { thisJourneyInfo[propName] = jsonObject[propName]; } } }; thisJourneyInfo.showWithData = function(data) {
            var legInfoStr = $(data).html(); var legInfoJson = SKYSALES.Json.parse(legInfoStr); var legInfoHash = legInfoJson.legInfo; var legInfo = null; var prop = ''; var propertyContainer = null; var propertyHtml = ''; var equipmentPropertyArray = null; var i = 0; var equipmentProperty = null; for (prop in legInfoHash) {
                if (legInfoHash.hasOwnProperty(prop)) {
                    propertyHtml = ''; legInfo = legInfoHash[prop]; if (legInfo.legIndex !== undefined) {
                        propertyContainer = $('#propertyContainer_' + thisJourneyInfo.key); equipmentPropertyArray = legInfo.equipmentPropertyArray; for (i = 0; i < equipmentPropertyArray.length; i += 1) { equipmentProperty = equipmentPropertyArray[i]; propertyHtml += '<div>' + equipmentProperty.name + ': ' + equipmentProperty.value + '<\/div>'; }
                        propertyContainer.html(propertyHtml);
                    } 
                } 
            }
            thisJourneyInfo.journeyContainer.show('slow');
        }; thisJourneyInfo.show = function() {
            var legInfoArray = thisJourneyInfo.legInfoArray; var legInfo = null; var postHash = {}; var prop = ''; var i = 0; var propName = thisJourneyInfo.clientName; for (i = 0; i < legInfoArray.length; i += 1) { legInfo = legInfoArray[i]; for (prop in legInfo) { if (legInfo.hasOwnProperty(prop)) { postHash[propName + '$legInfo_' + prop + '_' + i] = legInfo[prop]; } } }
            $.post(thisJourneyInfo.equipmentInfoUri, postHash, thisJourneyInfo.showWithData);
        }; thisJourneyInfo.hide = function() { thisJourneyInfo.journeyContainer.hide(); }; return thisJourneyInfo;
    };
}
if (!SKYSALES.Class.FareRule) { SKYSALES.Class.FareRule = function() { var parent = SKYSALES.Class.SkySales(), thisFareRule = SKYSALES.Util.extendObject(parent); thisFareRule.name = null; thisFareRule.data = null; thisFareRule.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.addEvents(); }; thisFareRule.addEvents = function() { }; thisFareRule.setSettingsByObject = function(json) { parent.setSettingsByObject.call(this, json); }; return thisFareRule; }; SKYSALES.Class.FareRule.createObject = function(json) { SKYSALES.Util.createObject('fareRule', 'FareRule', json); }; }; if (!SKYSALES.Class.FareDisplay) { SKYSALES.Class.FareDisplay = function() { var parent = SKYSALES.Class.SkySales(), thisFareDisplay = SKYSALES.Util.extendObject(parent); thisFareDisplay.fareDisplayInputId = ""; thisFareDisplay.fareDisplayInput = null; thisFareDisplay.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.addEvents(); }; thisFareDisplay.addEvents = function() { }; thisFareDisplay.setVars = function() { thisFareDisplay.fareDisplayInput = document.getElementById(thisFareDisplay.fareDisplayInputId); }; thisFareDisplay.setSettingsByObject = function(json) { parent.setSettingsByObject.call(this, json); }; return thisFareDisplay; }; SKYSALES.Class.FareDisplay.createObject = function(json) { SKYSALES.Util.createObject('fareDisplay', 'FareDisplay', json); }; }
if (!SKYSALES.Class.AvailabilityFareRulesDisplay) {
    SKYSALES.Class.AvailabilityFareRulesDisplay = function() {
        var parent = SKYSALES.Class.SkySales(), thisAvailabilityFareRulesDisplay = SKYSALES.Util.extendObject(parent); thisAvailabilityFareRulesDisplay.commonFareName = ""; thisAvailabilityFareRulesDisplay.flightFareList = null; thisAvailabilityFareRulesDisplay.fareRulesList = null; thisAvailabilityFareRulesDisplay.fareDisplayList = null; thisAvailabilityFareRulesDisplay.init = function(json) { this.setSettingsByObject(json); this.setVars(); this.addEvents(); }; thisAvailabilityFareRulesDisplay.addEvents = function() { var marketTables = $("#selectMainBody table[@id='availabilityTable']"), markets = null; $(marketTables).each(function(ctr) { markets = $(" tr td[@class^='fareCol'] :radio"); $(markets).each(function(i) { $(this).click(thisAvailabilityFareRulesDisplay.updateFareDisplay) }); }); }; thisAvailabilityFareRulesDisplay.updateFareDisplay = function() { var radioValue = this.value.split("~"), radioName = this.name, marketIndex = radioName.slice(radioName.length - 1, radioName.length); marketIndex = marketIndex - 1; if (radioValue.length > 2 && radioValue[1] !== "") { thisAvailabilityFareRulesDisplay.populateFareDisplay(marketIndex, radioValue[1]); } }; thisAvailabilityFareRulesDisplay.getFareData = function(fareClass) {
            var fareRulesList = thisAvailabilityFareRulesDisplay.fareRulesList; for (i = 0; i < fareRulesList.length; i++) { if (fareRulesList[i].name === fareClass) { return "<span>Class " + fareClass + "</span><br/><br/>" + fareRulesList[i].data; } }
            return "<span>Class " + fareClass + "</span><br/><br/>" + fareRulesList[0].data;
        }; thisAvailabilityFareRulesDisplay.populateFareDisplay = function(marketIndex, fareClass) { var fareDisplayList = thisAvailabilityFareRulesDisplay.fareDisplayList; if (fareDisplayList.length > marketIndex) { fareDisplayList[marketIndex].fareDisplayInput.innerHTML = "<p>" + thisAvailabilityFareRulesDisplay.getFareData(fareClass) + "</p>"; } }; thisAvailabilityFareRulesDisplay.setSettingsByObject = function(json) {
            parent.setSettingsByObject.call(this, json); var i = 0, fareRulesList = this.fareRulesList || [], fareRule = null, fareDisplayList = this.fareDisplayList || [], fareDisplay = null; for (i = 0; i < fareRulesList.length; i += 1) { fareRule = new SKYSALES.Class.FareRule(); fareRule.init(fareRulesList[i]); fareRulesList[i] = fareRule; }
            thisAvailabilityFareRulesDisplay.fareRulesList = fareRulesList; for (i = 0; i < fareDisplayList.length; i += 1) { fareDisplay = new SKYSALES.Class.FareDisplay(); fareDisplay.init(fareDisplayList[i]); fareDisplayList[i] = fareDisplay; }
            thisAvailabilityFareRulesDisplay.fareDisplayList = fareDisplayList;
        }; return thisAvailabilityFareRulesDisplay;
    }; SKYSALES.Class.AvailabilityFareRulesDisplay.createObject = function(json) { SKYSALES.Util.createObject('availabilityFareRulesDisplay', 'AvailabilityFareRulesDisplay', json); };
}; if (SKYSALES.Class.BaggageAllowance === undefined) {
    SKYSALES.Class.BaggageAllowance = function() {
        var parent = new SKYSALES.Class.SkySales(); var thisBG = SKYSALES.Util.extendObject(parent); thisBG.bagWeightTotalId = '#totalBGWeight'; thisBG.bagAmountTotalId = '#totalBGAmount'; thisBG.bookingSummaryTotalId = '#bookingSummaryTotal'; thisBG.init = function(paramObject) { thisBG.addEvents(); thisBG.calculateTotal(); }; thisBG.addEvents = function() { $("#bgTable #bgContainer tr").each(function() { $(this).find("td[@id^='bgControl'] select").each(function() { $(this).change(function() { thisBG.removeBaggageFromTotal(); thisBG.calculateTotal(); thisBG.updateBookingSummary(); thisBG.setBaggageAmount(); thisBG.updatePriceDetails(); }); }); }); }; thisBG.removeBaggageFromTotal = function() { var spanBagAmountTotal = $(thisBG.bagAmountTotalId); var bagAmountTotal = thisBG.removeComma(spanBagAmountTotal.text()); var spanBookingSummaryTotal = $(thisBG.bookingSummaryTotalId); var bookingSummaryTotal = thisBG.removeComma(spanBookingSummaryTotal.text()); bookingSummaryTotal = parseFloat(bookingSummaryTotal) - parseFloat(bagAmountTotal); spanBookingSummaryTotal.text(thisBG.addCommas(bookingSummaryTotal)); }; thisBG.calculateTotal = function() {
            var totalAmount = 0; var totalKg = 0; $("#bgTable #bgContainer tr").each(function() {
            $(this).find("td[@id^='bgControl'] select").each(function() {
            var amt = 0; var kg = 0; var id = $(this).attr("id"); var ddlBag = document.getElementById(id); if (ddlBag.selectedIndex != -1) { var arrValue = ddlBag.options[ddlBag.selectedIndex].value.split("_"); amt = (arrValue.length == 4) ? thisBG.removeComma(arrValue[1]) : 0; kg = (arrValue.length == 4) ? arrValue[0].replace(/\D/g, "") : 0; var passengerIndex = parseInt(id.split("_")[id.split("_").length - 1].split("SSRBAG")[0].substring(9)) + 1; var SSRIndex = parseInt(id.split("_")[id.split("_").length - 1].split("SSRBAG")[1]) + 1; if (arrValue.length != 4) { $("#toolTip" + passengerIndex + "_" + SSRIndex).show();} else { $("#toolTip" + passengerIndex + "_" + SSRIndex).hide(); } }
                    totalKg += parseInt(kg); totalAmount += parseFloat(amt);
                });
                $(this).find("td[@id^='bgControl'] span[id^='bagExisting']").each(function() { var amt = 0; var kg = 0; var arrValue = $(this).text().split(" "); amt = thisBG.removeComma(arrValue[4]); kg = arrValue[5]; totalKg += parseInt(kg); totalAmount += parseFloat(amt); });
            }); $(thisBG.bagAmountTotalId).text(thisBG.addCommas(totalAmount)); $(thisBG.bagWeightTotalId).text(totalKg);
        }; thisBG.updateBookingSummary = function() { var spanBagAmountTotal = $(thisBG.bagAmountTotalId); var bagAmountTotal = thisBG.removeComma(spanBagAmountTotal.text()); var spanBookingSummaryTotal = $(thisBG.bookingSummaryTotalId); var bookingSummaryTotal = thisBG.removeComma(spanBookingSummaryTotal.text()); bookingSummaryTotal = parseFloat(bookingSummaryTotal) + parseFloat(bagAmountTotal); spanBookingSummaryTotal.text(thisBG.addCommas(bookingSummaryTotal)); $(this).find("span[@id^='overallTotal']").each(function() { spanBookingSummaryTotal.text($("#overallTotal").text()); }); }; thisBG.removeComma = function(amount) { return amount.replace(/,/g, ""); }; thisBG.addCommas = function(nStr) {
            nStr += ''; x = nStr.split('.'); x1 = x[0]; x2 = x.length > 1 ? x[1] + '00' : '0000'; var d1 = x2.substr(0, 2); var d2 = x2.substr(2, x2.length); x2 = String(Math.round(d1 + "." + d2)); x2 = x2.length > 1 ? '.' + x2 : '.0' + x2; var rgx = /(\d+)(\d{3})/; while (rgx.test(x1)) { x1 = x1.replace(rgx, '$1' + ',' + '$2'); }
            return x1 + x2;
        }; thisBG.setBaggageAmount = function() { var spanBagAmountTotal = $(thisBG.bagAmountTotalId); var spanPricePEB = $("#pricePEB"); if (spanPricePEB !== undefined) { spanPricePEB.text(spanBagAmountTotal.text()); } }; thisBG.updatePriceDetails = function() {
            var divPriceDetails = $("#priceDetails"); if (divPriceDetails !== undefined) {
            var PriceWWF = thisBG.removeComma($("#priceWWF").text()); var PriceSEF = thisBG.removeComma($("#priceSEF").text()); var PriceINS = thisBG.removeComma($("#priceINS").text()); var PricePEB = thisBG.removeComma($("#pricePEB").text()); var PriceSEAT = thisBG.removeComma($("#priceSEAT").text()); var PriceWAF = thisBG.removeComma($("#priceWAF").text()); var PricePCF = thisBG.removeComma($("#pricePCF").text()); var cancelChangeFee = thisBG.removeComma($("#pricePF").text()); var PriceSMS = thisBG.removeComma($("#priceSMS").text()); var UMNRFee = thisBG.removeComma($("#priceUMNR").text()); var spoilageFee = thisBG.removeComma($("#priceSF").text()); var priceNAMECHANGE = thisBG.removeComma($("#priceNameChange").text()); var priceAIRBUS = thisBG.removeComma($("#airbTotal").text()); var priceCKIT = thisBG.removeComma($("#ckitTotal").text()); var addOnsSubTotal = $("#addOnsSubTotal"); var Total = $("#overallTotal"); var priceNBAG = ($("#priceNBAG")).text(); var taxesFaresTotal = thisBG.removeComma($("#taxesFaresTotal").text()); var faresSubTotal = thisBG.removeComma($("#faresSubTotal").text()); var subTotal; if (PricePCF != "") {
                    subTotal = (parseFloat(PriceWWF) + parseFloat(PriceSEF) + parseFloat(PriceINS)
+ parseFloat(PricePEB) + parseFloat(PriceSEAT) + parseFloat(PriceWAF)
+ parseFloat(PricePCF) + parseFloat(priceNBAG) + parseFloat(UMNRFee) + parseFloat(PriceSMS))
+ parseFloat(priceNAMECHANGE) + parseFloat(priceAIRBUS) + parseFloat(priceCKIT);
                }
                else {
                    subTotal = (parseFloat(PriceWWF) + parseFloat(PriceSEF) + parseFloat(PriceINS)
+ parseFloat(PricePEB) + parseFloat(PriceSEAT) + parseFloat(PriceWAF)
+ parseFloat(priceNBAG) + parseFloat(UMNRFee) + parseFloat(PriceSMS))
+ parseFloat(priceNAMECHANGE) + parseFloat(priceAIRBUS) + parseFloat(priceCKIT) + parseFloat(priceNBAG);
                }
                var xtotal = (parseFloat(faresSubTotal) + parseFloat(subTotal) + parseFloat(taxesFaresTotal)); if (cancelChangeFee != "") { xtotal = xtotal + parseFloat(cancelChangeFee); }
                addOnsSubTotal.text(thisBG.addCommas(subTotal.toFixed(2))); Total.text(thisBG.addCommas(xtotal.toFixed(2))); $(this).find("span[@id^='overallTotal']").each(function() { $("#bookingSummaryTotal").text($("#overallTotal").text()); });
            } 
        }; return thisBG;
    };
}

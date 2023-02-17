"use strict";

(function () {
    const props = {
        win: navigator.platform.indexOf('Win') !== -1,
        mac: navigator.platform.indexOf('Mac') !== -1,
        linux: navigator.platform.indexOf('Linux') !== -1,
        chrome: navigator.userAgent.indexOf('Chrome') !== -1,
        safari: navigator.userAgent.indexOf('Apple') !== -1,
        firefox: navigator.userAgent.indexOf('Firefox') !== -1,
        ie: navigator.userAgent.indexOf('MSIE') !== -1,
        opera: navigator.userAgent.indexOf('Opera') !== -1,
    };

    props.pother = !props.win && !props.mac && !props.linux;
    props.bother = !props.chrome && !props.safari && !props.firefox && !props.ie && !props.opera;

    function setup(node) {
        node.querySelectorAll('[data-for]').forEach(function (el) {
            const targets = el.getAttribute('data-for').split(' ');

            for (let i = 0; i<targets.length; i++) {
                let key = targets[i];

                if (key.substring(0, 1) === '!') {
                    if (!props[key.substring(1)]) {
                        el.style.display = 'initial';
                        return;
                    }
                } else if (props[key]) {
                    el.style.display = 'initial';
                    return;
                }
            }

            el.style.display = 'none';
        });
    }

    setup(document);
    new MutationObserver(function (mutationsList) {
        for(const mutation of mutationsList) {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function (element) {
                    if (element.querySelectorAll) {
                        setup(element)
                    }
                })
            }
        }
    }).observe(document, {
        attributes: false,
        childList: true,
        subtree: true
    });
})();

(function () {
    function autoResize(el) {
        if (!el) return;
        el.style.height = 'auto';
        el.style.height = (el.scrollHeight + 10) + 'px';
    }

    function bindCopy() {
        var copyButton = document.querySelector('[data-kb-fortis-copy]');
        var cli = document.querySelector('.kb-fortis-cli');

        if (!copyButton || !cli) return;

        copyButton.addEventListener('click', function () {
            cli.focus();
            cli.select();
            try {
                document.execCommand('copy');
            } catch (e) {}
        });

        autoResize(cli);
    }

    function bindCheckToggles() {
        var container = document.getElementById('kb-fortis-cli-blocks');
        if (!container) return;

        var checkAll = document.querySelector('[data-kb-fortis-check="all"]');
        var clearAll = document.querySelector('[data-kb-fortis-check="clear"]');
        var boxes = container.querySelectorAll('input[type="checkbox"]');

        if (checkAll) {
            checkAll.addEventListener('click', function () {
                boxes.forEach(function (cb) { cb.checked = true; });
            });
        }

        if (clearAll) {
            clearAll.addEventListener('click', function () {
                boxes.forEach(function (cb) { cb.checked = false; });
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        bindCopy();
        bindCheckToggles();
    });
})();

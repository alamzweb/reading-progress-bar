document.addEventListener('DOMContentLoaded', function () {
    const progressBars = document.querySelectorAll('.rpb-bar');
    if (progressBars.length === 0) return;

    let ticking = false;

    function updateProgress() {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        
        // Safety lock check if page is not scrollable
        const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;

        progressBars.forEach(function (bar) {
            bar.style.width = scrollPercent + '%';
        });

        ticking = false;
    }

    // Optimization: RequestAnimationFrame handles rendering throttles gracefully
    window.addEventListener('scroll', function () {
        if (!ticking) {
            window.requestAnimationFrame(updateProgress);
            ticking = true;
        }
    });

    // Fire initialization mapping for viewport checks
    updateProgress();
});

// Gutenberg Block Registration Definition Fallback
(function (blocks, element) {
    if (!blocks || !element) return;
    
    const el = element.createElement;

    blocks.registerBlockType('reading-progress-bar/block', {
        title: 'Reading Progress Bar',
        icon: 'ellipsis',
        category: 'widgets',
        edit: function () {
            return el(
                'div',
                { style: { padding: '15px', background: '#f1f1f1', border: '1px dashed #b4b9be', textAlign: 'center' } },
                '📖 [Reading Progress Bar Placeholder Element]'
            );
        },
        save: function () {
            return null; // Handle fallback dynamic runtime rendering dynamically in PHP
        },
    });
})(window.wp ? window.wp.blocks : null, window.wp ? window.wp.element : null);
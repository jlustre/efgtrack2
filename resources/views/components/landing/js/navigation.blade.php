{{--
Landing Page Navigation and Scroll JavaScript Component
Contains navigation and scroll-related functionality
--}}
<script>
    // Go to Top functionality
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Show/hide go to top button and enhance sticky navbar
    let lastScrollTop = 0;
    const navbar = document.querySelector('nav');
    const goToTopBtn = document.getElementById('goToTopBtn');
    
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Show/hide go to top button
        if (scrollTop > 300) {
            goToTopBtn.classList.remove('opacity-0', 'invisible');
            goToTopBtn.classList.add('opacity-100', 'visible');
        } else {
            goToTopBtn.classList.add('opacity-0', 'invisible');
            goToTopBtn.classList.remove('opacity-100', 'visible');
        }
        
        // Enhanced navbar behavior (optional shadow on scroll)
        if (scrollTop > 10) {
            navbar.classList.add('shadow-md');
            navbar.classList.remove('shadow-sm');
        } else {
            navbar.classList.remove('shadow-md');
            navbar.classList.add('shadow-sm');
        }
        
        lastScrollTop = scrollTop;
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeVideoModal();
            closeFeatureModal();
        }
    });
</script>
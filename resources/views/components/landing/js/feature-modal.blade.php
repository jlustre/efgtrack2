{{--
Landing Page Feature Modal Data and Functions JavaScript Component
Contains feature modal data and functionality
--}}
<script>
    // Feature modal data
    const featureData = {
        'mentoring': {
            title: 'Personalized Mentoring',
            description: 'Our personalized mentoring program connects you with experienced professionals in the financial services industry. Get one-on-one guidance tailored to your specific career goals, challenges, and aspirations.',
            benefits: [
                'Matched with mentors based on your career goals and industry interests',
                'Flexible scheduling to accommodate your busy lifestyle',
                'Regular progress check-ins and goal-setting sessions',
                'Access to exclusive industry insights and best practices',
                'Networking opportunities within the EFGTrack community'
            ],
            videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0'
        },
        'ai-modules': {
            title: 'AI-Powered Learning Modules',
            description: 'Experience the future of professional development with our AI-driven learning platform. Our intelligent modules adapt to your learning style, pace, and preferences to maximize your growth potential.',
            benefits: [
                'Personalized learning paths based on your strengths and weaknesses',
                'Real-time progress tracking and performance analytics',
                'Interactive simulations and real-world scenarios',
                'Adaptive content that evolves with your skill level',
                'Integration with industry-standard tools and platforms'
            ],
            videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0'
        },
        'analytics': {
            title: 'Progress Analytics',
            description: 'Transform your professional development with comprehensive analytics that provide deep insights into your growth trajectory. Track your progress, identify improvement areas, and celebrate your achievements.',
            benefits: [
                'Detailed performance dashboards with visual reports',
                'Goal tracking and milestone management',
                'Comparative analysis against industry benchmarks',
                'Predictive insights for future career opportunities',
                'Exportable reports for performance reviews and career planning'
            ],
            videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0'
        },
        'collaboration': {
            title: 'Team Collaboration',
            description: 'Foster meaningful connections and drive collective success with our advanced collaboration tools. Work seamlessly with your team, share knowledge, and achieve goals together within your organizational hierarchy.',
            benefits: [
                'Role-based access and hierarchical team management',
                'Shared goal setting and progress tracking across teams',
                'Knowledge sharing platform with best practices library',
                'Real-time communication and feedback systems',
                'Team performance analytics and insights'
            ],
            videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0'
        },
        'licensing': {
            title: 'Licensing Support',
            description: 'Navigate the complex world of financial licensing with confidence. Our comprehensive licensing support program provides you with everything needed to obtain and maintain your professional licenses in the financial services industry.',
            benefits: [
                'Comprehensive study guides for Series 7, 66, 63, and other key licenses',
                'Interactive practice exams with detailed explanations',
                'Personalized study plans based on your timeline and goals',
                'Expert tutoring sessions with licensed professionals',
                'License maintenance and continuing education tracking',
                'State-specific requirements and application assistance'
            ],
            videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0'
        },
        'resources': {
            title: 'Resource Center',
            description: 'Access our comprehensive digital library featuring thousands of professional-grade resources designed to accelerate your success in the financial services industry. Everything you need is organized and easily accessible in one centralized location.',
            benefits: [
                'Professional sales scripts and conversation starters',
                'PowerPoint presentations for client meetings and prospecting',
                'Video training library with industry experts and top producers',
                'Marketing materials and templates for social media and print',
                'Industry reports, market analysis, and economic updates',
                'Compliance-approved content and regulatory guidelines'
            ],
            videoUrl: 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0'
        }
    };

    function openFeatureModal(featureId) {
        const modal = document.getElementById('featureModal');
        const data = featureData[featureId];
        
        if (!data) return;
        
        // Update modal content
        document.getElementById('featureModalTitle').textContent = data.title;
        document.getElementById('featureModalDescription').textContent = data.description;
        
        // Update benefits list
        const benefitsList = document.getElementById('featureModalBenefits');
        benefitsList.innerHTML = '';
        data.benefits.forEach(benefit => {
            const li = document.createElement('li');
            li.className = 'flex items-start';
            li.innerHTML = `
                <svg class="h-5 w-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-700">${benefit}</span>
            `;
            benefitsList.appendChild(li);
        });
        
        // Update video button
        const videoButton = document.getElementById('featureVideoButton');
        videoButton.onclick = () => openFeatureVideo(data.videoUrl);
        
        // Show modal
        modal.style.display = 'flex';
    }

    function closeFeatureModal() {
        const modal = document.getElementById('featureModal');
        modal.style.display = 'none';
    }
</script>
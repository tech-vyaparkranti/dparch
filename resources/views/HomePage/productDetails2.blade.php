@extends('layouts.webSite')
@section('title', 'Services')
   
@section('content')

    <!-- Top Banner -->
    <div class="information-page-slider">
        <div class="information-content">
            <h1><a href="{{ url('/') }}">Home</a><span>Project Details</span></h1>
        </div>
    </div>
    <div class="project-banner-header">
        <h1>Projects</h1>
    </div>

    <div class="project-container">
        <div class="project-content-wrapper">
            <!-- Main Content -->
            <div class="project-main-content">
                <!-- Project Header -->
                <div class="project-header-section">
                    <div class="project-banner-image">
                        E-Commerce Platform Banner
                    </div>
                    
                    <div class="project-title-section">
                        <div class="project-icon-circle">EP</div>
                        <h2>E-Commerce Platform</h2>
                    </div>
                    
                    <div class="project-description-text">
                        A comprehensive e-commerce solution built with modern technologies. This platform features a responsive design, secure payment integration, inventory management, and user-friendly interface. The system supports multiple payment methods, real-time order tracking, and advanced analytics dashboard for business insights. Built with scalability in mind, it can handle thousands of concurrent users and provides seamless shopping experience across all devices.
                    </div>
                </div>

                <!-- Gallery Section -->
                <div class="project-gallery-section">
                    <h3 class="project-gallery-title">Project Gallery</h3>
                    <div class="project-gallery-grid">
                        <div class="project-gallery-item">Homepage</div>
                        <div class="project-gallery-item">Product Page</div>
                        <div class="project-gallery-item">Shopping Cart</div>
                        <div class="project-gallery-item">Checkout</div>
                        <div class="project-gallery-item">Dashboard</div>
                        <div class="project-gallery-item">Analytics</div>
                        <div class="project-gallery-item">Mobile View</div>
                        <div class="project-gallery-item">Admin Panel</div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="project-sidebar">
                <h3>Recent Projects</h3>
                <div class="recent-projects-list">
                    <div class="recent-project-item">
                        <div class="recent-project-banner">Social Media App</div>
                        <h4>Social Media App</h4>
                        <p>A modern social networking platform with real-time messaging and content sharing features.</p>
                    </div>
                    
                    <div class="recent-project-item">
                        <div class="recent-project-banner">Task Manager</div>
                        <h4>Task Management System</h4>
                        <p>Comprehensive project management tool with team collaboration and progress tracking.</p>
                    </div>
                    
                    <div class="recent-project-item">
                        <div class="recent-project-banner">Portfolio Website</div>
                        <h4>Portfolio Website</h4>
                        <p>Responsive portfolio showcasing creative work with smooth animations and modern design.</p>
                    </div>
                    
                    <div class="recent-project-item">
                        <div class="recent-project-banner">Learning Platform</div>
                        <h4>Online Learning Platform</h4>
                        <p>Educational platform with video streaming, quizzes, and progress tracking for students.</p>
                    </div>
                    
                    <div class="recent-project-item">
                        <div class="recent-project-banner">Restaurant App</div>
                        <h4>Restaurant Booking App</h4>
                        <p>Mobile-first application for restaurant reservations with real-time availability.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .project-banner-header {
            position: relative;
            height: 300px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .project-banner-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300"><polygon fill="rgba(255,255,255,0.1)" points="0,100 50,120 100,100 150,130 200,110 250,140 300,120 350,150 400,130 450,160 500,140 550,170 600,150 650,180 700,160 750,190 800,170 850,200 900,180 950,210 1000,190 1000,300 0,300"/></svg>') no-repeat center center;
            background-size: cover;
        }

        .project-banner-header h1 {
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            z-index: 1;
            position: relative;
        }

        .project-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .project-content-wrapper {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 30px;
            margin-bottom: 50px;
        }

        .project-main-content {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .project-main-content:hover {
            transform: translateY(-5px);
        }

        .project-header-section {
            margin-bottom: 30px;
        }

        .project-banner-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .project-title-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .project-icon-circle {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .project-title-section h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin: 0;
        }

        .project-description-text {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .project-gallery-section {
            margin-top: 40px;
        }

        .project-gallery-title {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }

        .project-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .project-gallery-item {
            aspect-ratio: 1;
            background: linear-gradient(45deg, #f093fb, #f5576c);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .project-gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .project-sidebar {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .project-sidebar h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .recent-projects-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .recent-project-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .recent-project-item:hover {
            background: #e9ecef;
            border-color: #667eea;
            transform: translateX(5px);
        }

        .recent-project-banner {
            width: 100%;
            height: 80px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .recent-project-item h4 {
            font-size: 1.1rem;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .recent-project-item p {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .project-banner-header h1 {
                font-size: 2.5rem;
            }

            .project-content-wrapper {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .project-main-content, .project-sidebar {
                padding: 20px;
            }

            .project-title-section {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .project-title-section h2 {
                font-size: 2rem;
            }

            .project-banner-image {
                height: 200px;
            }

            .project-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .project-sidebar {
                position: static;
                order: -1;
            }
        }

        @media (max-width: 480px) {
            .project-banner-header {
                height: 200px;
            }

            .project-banner-header h1 {
                font-size: 2rem;
            }

            .project-container {
                padding: 0 15px;
            }

            .project-main-content, .project-sidebar {
                padding: 15px;
            }

            .project-title-section h2 {
                font-size: 1.5rem;
            }

            .project-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }
        }
    </style>
@endsection

@section('script')
    <script>
        // Add interactive features
        document.querySelectorAll('.project-gallery-item').forEach(item => {
            item.addEventListener('click', function() {
                this.style.background = 'linear-gradient(45deg, #667eea, #764ba2)';
                setTimeout(() => {
                    this.style.background = 'linear-gradient(45deg, #f093fb, #f5576c)';
                }, 200);
            });
        });

        document.querySelectorAll('.recent-project-item').forEach(project => {
            project.addEventListener('click', function() {
                const projectName = this.querySelector('h4').textContent;
                alert(`Loading ${projectName}...`);
            });
        });

        // Smooth scroll effect
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const banner = document.querySelector('.project-banner-header');
            if (banner) {
                banner.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    </script>
@endsection
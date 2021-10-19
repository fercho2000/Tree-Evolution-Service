<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tree Evolution Service</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Favicons
    ================================================== -->
  <link rel="shortcut icon" href="<?php echo e(asset('assets/img/login/logoArbolERTreeServices.png')); ?>" />
  <link rel="apple-touch-icon" href="<?php echo e(asset('page/img/apple-touch-icon.png')); ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(asset('page/img/apple-touch-icon-72x72.png')); ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(asset('page/img/apple-touch-icon-114x114.png')); ?>">

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('page/css/bootstrap.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/fontawesome/css/all.min.css')); ?>">

  <!-- Slider
    ================================================== -->
  <link href="<?php echo e(asset('page/css/owl.carousel.css')); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo e(asset('page/css/owl.theme.css')); ?>" rel="stylesheet" media="screen">

  <!-- Stylesheet
    ================================================== -->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('page/css/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('page/css/nivo-lightbox/nivo-lightbox.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('page/css/nivo-lightbox/default.css')); ?>">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- Bar social network -->
  <link rel="stylesheet" href="<?php echo e(asset('page/css/all.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('page/css/estilos.css')); ?>">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


  <!-- Bar social network ER Tree Services -->
  <div class="container">
    <div class="row">
      <div class="social">

        <ul>
          <li><a target="_blank" href="https://www.facebook.com/ertreeservices87/" class="fab fa-facebook-square"></a></li>
          <li><a href="mailto:ertreeservices@gmail.com" class="fab fa-google"></a></li>
          <li><a target="_blank" href="https://www.instagram.com/ertreeservices38/?hl=es-la" class="fab fa-instagram"></a></li>
          <li><a target="_blank" href="https://www.houzz.es/pro/ernest-ramos/er-tree-services" class="fab fa-houzz"></a></li>
          <li><a target="_blank" href="https://www.yelp.com/biz/er-tree-services-saint-petersburg" class="fab fa-yelp"></a></li>
        </ul>
      </div>
    </div>
  </div>


  <!-- Navigation
    ==========================================-->
  <nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand page-scroll pull-left" href="#page-top">Tree Evolution Service</a> </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#about" class="page-scroll">About</a></li>
          <li><a href="#services" class="page-scroll">Services</a></li>
          <li><a href="#portfolio" class="page-scroll">Gallery</a></li>
          <li><a href="#testimonials" class="page-scroll">Testimonials</a></li>
          <li><a href="#contact" class="page-scroll">Contact</a></li>

          <?php if(auth()->guard()->check()): ?>
          <li><a href="<?php echo e(url('login')); ?>" class="page-scroll"><i class="fas fa-home-lg"></i> Dashboard</a></li>
          <?php endif; ?>

          <?php if(auth()->guard()->guest()): ?>
          <li><a href="<?php echo e(url('login')); ?>" class="page-scroll">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
  <!-- Header -->
  <header id="header">
    <div class="intro">
      <div class="overlay">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-2 intro-text">
              <h1>landscaping services</h1>
              <p>​ ​ We provide a full range of superior tree services including all phases <br>
                of tree work at affordable rates.</p>
              <a href="#about" class="btn btn-custom btn-lg page-scroll">More Info</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- About Section -->
  <div id="about">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <div class="about-text">
            <h2>Welcome to <span>Tree Evolution Service</span></h2>
            <hr>
            <p>We provide a full range of superior tree services including all phases of tree work at affordable rates.</p>
            <p>We are dedicated to building long-term relationships with our clients by providing the highest standards of quality on each and every project we do .</p>
            <p><span> Licenced, Insured, Profesional, Experienced</span></p>
            <a href="#services" class="btn btn-custom btn-lg page-scroll">View All Services</a>
          </div>
        </div>
        <div class="col-xs-12 col-md-3">
          <div class="about-media"> <img src="<?php echo e(asset('page/img/about-1.jpg')); ?>" alt=" "> </div>
          <div class="about-desc">
            <h3>Cutting Trees</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam sedasd commodo nibh ante facilisis.</p>
          </div>
        </div>
        <div class="col-xs-12 col-md-3">
          <div class="about-media"> <img src="<?php echo e(asset('page/img/about-2.jpg')); ?>" alt=" "> </div>
          <div class="about-desc">
            <h3>Arranging Gardens</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam sedasd commodo nibh ante.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Services Section -->
  <div id="services">
    <div class="container">
      <div class="col-md-10 col-md-offset-1 section-title text-center">
        <h2>Our Services</h2>
        <hr>
        <p>We implement high quality standards in a diverse range of services.</p>
      </div>
      <div class="row">
        <div class="col-md-3 text-center">
          <div class="service-media"> <img src="<?php echo e(asset('page/img/services/service-1.jpg')); ?>" alt=" "> </div>
          <div class="service-desc">
            <h3>Tree removal</h3>
            <p>We use ropes and pulleys to carefully lower large limbs near houses to the ground slowly, with ground crew to support our climbers.</p>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="service-media"> <img src="<?php echo e(asset('page/img/services/service-2.jpg')); ?>" alt=" "> </div>
          <div class="service-desc">
            <h3>Stump Grinding</h3>
            <p>We are equipped with powerful tools to safely remove tree stumps.</p>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="service-media"> <img src="<?php echo e(asset('page/img/services/service-3.jpg')); ?>" alt=" "> </div>
          <div class="service-desc">
            <h3>Landscape maintenance</h3>
            <p>change the landscape of your home and select one of your liking.</p>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="service-media"> <img src="<?php echo e(asset('page/img/services/service-4.jpg')); ?>" alt=" "> </div>
          <div class="service-desc">
            <h3>All phases of tree pruning</h3>
            <p>We carry out a complete process of removal of trees which have completed their life cycle.</p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Gallery Section -->
  <div id="portfolio">
    <div class="container">
      <div class="section-title text-center center">
        <h2>Project Gallery</h2>
        <hr>
        <p>These are some of our services.</p>
      </div>
      <div class="categories">
        <ul class="cat">
          <li>
            <ol class="type">
              <li><a href="#" data-filter="*" class="active">All</a></li>
              <li><a href="#" data-filter=".lawn">Lawn Care</a></li>
              <li><a href="#" data-filter=".garden">Garden Care</a></li>
              <li><a href="#" data-filter=".planting">Planting</a></li>
            </ol>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="row">
        <div class="portfolio-items">
          <div class="col-sm-6 col-md-4 lawn">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/02.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Lorem Ipsum</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/02.jpg')); ?>" class="img-responsive" alt="Project Title" data-lightbox-gallery="gallery1">
                </a> </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 planting">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/03.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Adipiscing Elit</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/03.jpg')); ?>" class="img-responsive" alt="Project Title">
                </a> </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 lawn">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/05.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Lorem Ipsum</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/05.jpg')); ?>" class="img-responsive" alt="Project Title">
                </a> </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 lawn">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/07.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Lorem Ipsum</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/07.jpg')); ?>" class="img-responsive" alt="Project Title">
                </a> </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 planting">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/09.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Adipiscing Elit</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/09.jpg')); ?>" class="img-responsive" alt="Project Title">
                </a> </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 garden">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/11.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Dolor Sit</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/11.jpg')); ?>" class="img-responsive" alt="Project Title">
                </a> </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 garden">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/13.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Dolor Sit</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/13.jpg')); ?>" class="img-responsive" alt="Project Title">
                </a> </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 lawn">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/15.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Lorem Ipsum</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/15.jpg')); ?>" class="img-responsive" alt="Project Title">
                </a> </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 planting">
            <div class="portfolio-item">
              <div class="hover-bg"> <a href="<?php echo e(asset('page/img/portfolio/17.jpg')); ?>" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Adipiscing Elit</h4>
                  </div>
                  <img src="<?php echo e(asset('page/img/portfolio/17.jpg')); ?>" class="img-responsive" alt="Project Title">
                </a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Testimonials Section -->
  <div id="testimonials" class="text-center">
    <div class="overlay">
      <div class="container">
        <div class="section-title">
          <h2>Testimonials</h2>
          <hr>
        </div>
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div id="testimonial" class="owl-carousel owl-theme">
              <div class="item">
                <p>"Ernest was very professional and accommodating through the whole process. Work was completed as agreed with attention to details and in a timely manner. I would certainly recommend him."</p>
                <p>- Curtis C.</p>
              </div>
              <div class="item">
                <p>"Wow I can't enough about the job Ernest and his crew did for us and what a great price.every thing cut and cleaned up excellently done. If you want top notch service hire him.I give these guys 10 stars."</p>
                <p>- Mary H.</p>
              </div>
              <div class="item">
                <p>"Ernest cut down a tree that was to close to my house. He did a fantastic job cutting and cleaning up the limbs. Was on time and he and his helper were very hard workers. Would recommend them to anybody and will definitely use them again."</p>
                <p>- Wendell S.</p>
              </div>
              <div class="item">
                <p>"Ernest is awesome! He is dependable, affordable and simply awesome! So refreshing to hire a professional! My trees look awesome too!!!! He gets 6 stars in my book!"</p>
                <p>- Tree Planting</p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Contact Section -->
  <div id="contact" class="text-center">
    <div class="container">
      <div class="section-title text-center">
        <h2>Contact Us</h2>
        <hr>
        <p>know our schedules and ways to contact us.</p>
      </div>
      <div class="col-md-10 col-md-offset-1 contact-info">
        <div class="col-md-4">
          <h3>Address</h3>
          <hr>
          <div class="contact-item">
            <p>1401 55th St S, </p>
            <p> Gulfport, FL 33707, EE. UU.</p>
            <p>ZIP: 33711</p>
          </div>
        </div>
        <div class="col-md-4">
          <h3>Working Hours</h3>
          <hr>
          <div class="contact-item">
            <p>Mon - Fri 9:30 am - 8:00 pm</p>
            <p>Saturday Closed</p>
            <p>Sunday Closed</p>
          </div>
        </div>
        <div class="col-md-4">
          <h3>Contact Info</h3>
          <hr>
          <div class="contact-item">
            <p>Phone: 813-454-6085</p>
            <p>Email: <a href="mailto:ERTreeServices@gmail.com">ertreeservices@gmail.com</a></p>
          </div>
        </div>
      </div>
      <br>
      <br>
     


      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 pull-right">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3530.720312571695!2d-82.71045108561421!3d27.756771429926445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c2e2eb505adb9f%3A0x3d67ad82e3a5d424!2s1401+55th+St+S%2C+Gulfport%2C+FL+33707%2C+EE.+UU.!5e0!3m2!1ses!2sco!4v1559751217554!5m2!1ses!2sco" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>

          <div class="card col-md-6">
            <div class="card-body">
              <h3>Send us a message</h3>
              <form name="sentMessage" id="contactForm" novalidate>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" id="name" class="form-control" placeholder="Name" required="required">
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" id="lastname" class="form-control" placeholder="Last name" required="required">
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="number" id="phone" class="form-control" placeholder="Phone" required="required">
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="email" id="email" class="form-control" placeholder="Email" required="required">
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
                  <p class="help-block text-danger"></p>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-custom btn-lg">Send Message</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div id="footer">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
       
          <p>&copy; 2016 Landscaper. Designed Template by <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="<?php echo e(asset('page/js/jquery.1.11.1.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('page/js/bootstrap.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('page/js/SmoothScroll.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('page/js/nivo-lightbox.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('page/js/jquery.isotope.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('page/js/owl.carousel.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('page/js/jqBootstrapValidation.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('page/js/contact_me.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('page/js/main.js')); ?>"></script>

</body>

</html><?php /**PATH D:\ErTreeServices\Fercho\Tree-Evolution-Service\resources\views/page/index.blade.php ENDPATH**/ ?>
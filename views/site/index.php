<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$baseUrl = Url::base() . '/academic';
$this->title = 'PMRO - Predictive Maintenance System of Hemodialysis Reverse Osmosis Water Purification System';

?>



<div class="hero-slide owl-carousel site-blocks-cover">

  <?php foreach ($banner_list as $key => $value) : ?>
    <div class="intro-section" style="background-image: url('<?= Url::base() ?>/<?= $value["b_foto"] ?>');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
            <h1><a class="text-white" href="<?= $value["b_link"] ?>"><?= $value["b_title"] ?></a></h1>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<div></div>

<div class="site-section">
  <div class="container">
    <div class="row mb-8 justify-content-center text-center">
      <div class="col-lg-6 mb-5">
        <h2 class="section-title-underline mb-5">
          <span>Why PMRO ?</span>
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

        <div class="feature-1 border">
          <div class="icon-wrapper bg-primary">
            <span class="flaticon-mortarboard text-white"></span>
          </div>
          <div class="feature-1-content">
            <h2>Personalize AI Learning</h2>
            <p>Personalized AI learning is an Artificial Intelligence approach that aims to customize learning for each hospital's Riverse Osmosis System.</p>
            <p><a href="<?= Url::to(['site/about']) ?>" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <div class="feature-1 border">
          <div class="icon-wrapper bg-primary">
            <span class="flaticon-school-material text-white"></span>
          </div>
          <div class="feature-1-content">
            <h2>Trusted Data</h2>
            <p>We choose the best sensors on the market, and create the best data recording for RO monitoring system</p>
            <p><a href="<?= Url::to(['site/about']) ?>" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <div class="feature-1 border">
          <div class="icon-wrapper bg-primary">
            <span class="flaticon-library text-white"></span>
          </div>
          <div class="feature-1-content">
            <h2>Advanced Tools</h2>
            <p>We created the best tools to support the IOT devices including sensors to provide data into Artificial Intelligence.</p>
            <p><a href="<?= Url::to(['site/about']) ?>" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="section-bg style-1" style="background-image: url('<?= $baseUrl ?>/images/about_1.jpg');">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <h2 class="section-title-underline style-2">
          <span>About Us</span>
        </h2>
      </div>
      <div class="col-lg-8">
        <p class="lead text-white">PMRO </p>
        <p class="text-white">Predictive Maintenance System of Hemodialysis Reverse Osmosis Water Purification System (PMRO).</p>
        <p class="text-white"><a class="text-primary" href="#">Read more</a></p>
      </div>
    </div>
  </div>
</div>

<!-- // 05 - Block -->
<!-- <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-4">
            <h2 class="section-title-underline">
              <span>Testimonials</span>
            </h2>
          </div>
        </div>


        <div class="owl-slide owl-carousel">

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="<?= $baseUrl ?>/images/person_1.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="<?= $baseUrl ?>/images/person_2.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="<?= $baseUrl ?>/images/person_4.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="<?= $baseUrl ?>/images/person_3.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="<?= $baseUrl ?>/images/person_2.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="<?= $baseUrl ?>/images/person_4.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
            </div>
          </div>

        </div>
        
      </div>
    </div> -->


<!-- <div class="section-bg style-1" style="background-image: url('<?= $baseUrl ?>/images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-mortarboard"></span>
            <h3>Our Philosphy</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-school-material"></span>
            <h3>Academics Principle</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-library"></span>
            <h3>Key of Success</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
        </div>
      </div>
    </div> -->

<!-- <div class="news-updates">
  <div class="container">

    <div class="row">
      <div class="col-lg-9">
        <div class="section-heading">
          <h2 class="text-black">News &amp; Updates</h2>
          <a href="#">Read All News</a>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="post-entry-big">
              <a href="news" class="img-link"><img src="<?= $baseUrl ?>/images/blog_large_1.jpg" alt="Image" class="img-fluid"></a>
              <div class="post-content">
                <div class="post-meta">
                  <a href="#">November 6, 2020</a>
                  <span class="mx-1">/</span>
                  <a href="#">Admission</a>, <a href="#">Updates</a>
                </div>
                <h3 class="post-heading"><a href="news">Campus Camping and Learning Session</a></h3>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="post-entry-big horizontal d-flex mb-4">
              <a href="news" class="img-link mr-4"><img src="<?= $baseUrl ?>/images/blog_1.jpg" alt="Image" class="img-fluid"></a>
              <div class="post-content">
                <div class="post-meta">
                  <a href="#">October 26, 2020</a>
                  <span class="mx-1">/</span>
                  <a href="#">Admission</a>, <a href="#">Updates</a>
                </div>
                <h3 class="post-heading"><a href="news">Campus Camping and Learning Session</a></h3>
              </div>
            </div>

            <div class="post-entry-big horizontal d-flex mb-4">
              <a href="news" class="img-link mr-4"><img src="<?= $baseUrl ?>/images/blog_2.jpg" alt="Image" class="img-fluid"></a>
              <div class="post-content">
                <div class="post-meta">
                  <a href="#">October 16, 2020</a>
                  <span class="mx-1">/</span>
                  <a href="#">Admission</a>, <a href="#">Updates</a>
                </div>
                <h3 class="post-heading"><a href="news">Campus Camping and Learning Session</a></h3>
              </div>
            </div>

            <div class="post-entry-big horizontal d-flex mb-4">
              <a href="news" class="img-link mr-4"><img src="<?= $baseUrl ?>/images/blog_1.jpg" alt="Image" class="img-fluid"></a>
              <div class="post-content">
                <div class="post-meta">
                  <a href="#">October 6, 2020</a>
                  <span class="mx-1">/</span>
                  <a href="#">Admission</a>, <a href="#">Updates</a>
                </div>
                <h3 class="post-heading"><a href="news">Campus Camping and Learning Session</a></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="section-heading">
          <h2 class="text-black">Course Videos</h2>
          <a href="#">View All Videos</a>
        </div>
        <iframe src="https://www.youtube.com/embed/qlHCVs69biE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/YbEZOT8rVW4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div> -->

<div class="site-section ftco-subscribe-1" style="background-image: url('<?= $baseUrl ?>/images/bg_1.jpg')">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <h2>Subscribe to us!</h2>
        <p>You can have the best deal from us first for your Intelligence hospital,</p>
        <div style="text-align:center;" id="error">
          <!-- error will be shown here ! -->
        </div>
      </div>
      <div class="col-lg-5">
        <form class="d-flex" id="subscribe_form">
          <input type="text" id="subs_email" name="subs_email" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
          <button name="btn-subs" id="btn-subs" class="btn btn-primary rounded py-3 px-4" type="submit">Subscribe</button>
        </form>
      </div>
    </div>
  </div>
</div>
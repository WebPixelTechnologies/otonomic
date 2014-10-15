  <!-- Header -->
  <?php include 'header.php'; ?>

  <div id="main-wrapper" class="support-center">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Support center</h1>
        <!-- Social buttons -->
        <?php include 'social-buttons.php'; ?>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-12">
              <h3>Otonomic Support</h3>
              <p class="text-block">Otonomic is the world's simplest website builder. In a single click, Otonomic turns a user's Facebook business page into a professional website that updates automatically with new content posted on Facebook and other social media. The company is backed by leading VCs and angel investors, and launched its product on May 2014 with over 30,000 sites created in the platform so far.</p>
              <div class="thumbnail">
                <img src="http://localhost//marketingWebsite/pages/satellite-pages/images/image1.png" class="img-responsive" width="100%">
              </div>
            </div>
          </div>
          <!-- CTA -->
          <div class="row">
              <div class="col-md-12">
                <span>1-click website from your facebook page</span>
                <a href="#" class="btn navbar-btn btn-oto-orange">Create Your Website Now</a>
              </div>
          </div><!-- /CTA -->
          <div class="row">
                <div class="col-md-5">
                  <h4 class="contact-title">Was this handy?</h4>
                </div>
                <div class="col-md-7">
                  <div class="row">
                    <div class="col-xs-6">
                      <a href="#" class="btn btn-block btn-oto-blue btn-xlarge text-center"><span class="glyphicons thumbs_up"></span> Yes</a>
                    </div>
                    <div class="col-xs-6">
                      <a href="#" class="btn btn-block btn-oto-blue btn-xlarge text-center"><span class="glyphicons thumbs_down"></span> No</a>
                    </div>
                  </div>
                </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h3>Did you find your answer</h3>
              <div class="row">
                <div class="col-md-5">
                  <h4 class="contact-title">Send us an Email</h4>
                </div>
                <div class="col-md-7">
                  <a href="mailto:support@otonomic.com" class="btn btn-block btn-oto-blue btn-xlarge " style="text-align:left;"><span class="glyphicons message_full"></span> support@otonomic.com</a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <h4 class="contact-title">Or fill a contact form</h4>
                </div>
                <div class="col-md-7">
                  <!-- <a href="#" class="btn btn-block btn-oto-blue btn-xlarge"><span class="glyphicons notes_2"></span> Fill out this form</a> -->
                    <div class="panel-group" id="contactAccordion">
                        <div class="panel panel-oto panel-blue">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#contactAccordion" href="#contactAccordion1">
                                <span class="glyphicons notes_2"></span> Fill out this form
                              </a>
                            </h4>
                          </div>
                          <div id="contactAccordion1" class="panel-collapse collapse">
                            <div class="panel-body">
                              <form role="form">
                                    <div class="form-group">
                                        <label for="inputName">Name</label>
                                        <input type="text" class="form-control" id="inputName" placeholder="e.g John Doe">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Email</label>
                                        <input type="email" class="form-control" id="inputEmail" placeholder="e.g johndoe@gmail.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMessage">What's on your mind</label>
                                        <textarea name="inputMessage" class="form-control" rows="3" placeholder="Tell us what's bothering you"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-oto-blue btn-cornered">
                                        Let us know
                                    </button>
                                </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group has-feedback">
              <label class="control-label sr-only" for="search-faq-field">Search faq...</label>
              <input type="text" id="search-faq-field" class="form-control" placeholder="Search faq...">
              <span class="glyphicons search form-control-feedback js-search-icon"></span>
          </div>
          <a href="#website" class="btn btn-oto-white">Website</a>
          <a href="#website" class="btn btn-oto-white">Brand</a>
          <a href="#website" class="btn btn-oto-white">Store</a>
          <a href="#website" class="btn btn-oto-white">Widgets</a>
          <a href="#website" class="btn btn-oto-white">Responsive</a>
          <a href="#website" class="btn btn-oto-white">Parallax</a>
          <a href="#website" class="btn btn-oto-white">Mobile</a>
          <a href="#website" class="btn btn-oto-white">Log-In</a>
        </div>
      </div>
    </div> <!-- /container -->
    <!-- Footer -->
    <?php include 'footer.php'; ?>
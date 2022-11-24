<!-- ======= Contact Section ======= -->
<section id="contact">
    <div class="container" data-aos="fade-up">
      <div class="row">

        <div class="col-lg-4 col-md-4">
          <div class="contact-about">
            <h3>Avilon</h3>
            <p>Cras fermentum odio eu feugiat. Justo eget magna fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="info">
            <div>
              <i class="bi bi-geo-alt"></i>
              <p>A108 Adam Street<br>New York, NY 535022</p>
            </div>

            <div>
              <i class="bi bi-envelope"></i>
              <p>info@example.com</p>
            </div>

            <div>
              <i class="bi bi-phone"></i>
              <p>+1 5589 55488 55s</p>
            </div>

          </div>
        </div>

        <div class="col-lg-5 col-md-8">
          <div class="form">
            <form action="{{ url('forms/contact.php') }}" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-lg-6">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="form-group col-lg-6 mt-3 mt-lg-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit" title="Send Message">Send Message</button></div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

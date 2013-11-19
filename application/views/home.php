<?php $this->load->view('header');?>
<div id="header">
  <div class="row-1">
    <div class="fleft"><a href="#">UofT <span>Cinema</span></a></div>
    <ul>
      <li><a href="#"><img src="/asset/images/icon1-act.gif" alt="" /></a></li>
      <li><a href="#"><img src="/asset/images/icon2.gif" alt="" /></a></li>
      <li><a href="#"><img src="/asset/images/icon3.gif" alt="" /></a></li>
    </ul>
  </div>
  <div class="row-2">
    <ul>
      <li><a href="#" class="active">Home</a></li>
      <li><a href="/">Theater</a></li>
      <li><a href="/admin">Admin</a></li>
    </ul>
  </div>
</div>
<div id="content">
  <div id="slogan">
    <div class="image png"></div>
    <div class="inside">
      <h2>We are breaking<span>All Limitations</span></h2>
      <p>Canada's #1 University Theatre is here! With six dollars, we provide the equal knowledge and skill an Art Student will obtain in four years. <br> "To be a winner, you first need to watch movie like one." - Prof. Frankestein</p>
      <div class="wrapper"><a id="buyTicket" href="#" class="link1"><span><span>Buy Ticket Now</span></span></a></div>
    </div>
  </div>
  <div id="initialPage">
    <div class="box">
      <div class="border-right">
        <div class="border-left">
          <div class="inner">
            <h3>Our <span>Team</span></h3>
            <ul class="list">
              <li><img src="/asset/images/2page-img1.jpg" alt="" /><a href="#">Samuel Chien</a><br />
                Student Number: 998758759</li>
              <li><img src="/asset/images/2page-img2.jpg" alt="" /><a href="#">Maria-Rafailia Tsimpoukelli</a><br />
                Student Number: 996572588</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <h3>Fresh <span>Movies</span></h3>
      <ul class="movies">
        <li>
          <h4>Toy Story 3</h4>
          <img src="/asset/images/1page-img2.jpg" alt="" />
          <p>A story about toys I think. Oh, they can talk too!</p>
          <div class="wrapper"><a href="#" class="link2"><span><span>Read More</span></span></a></div>
        </li>
        <li>
          <h4>Prince of Percia: Sands of Time</h4>
          <img src="/asset/images/1page-img3.jpg" alt="" />
          <p>Pretty sure there is a prince in this movie.</p>
          <div class="wrapper"><a href="#" class="link2"><span><span>Read More</span></span></a></div>
        </li>
        <li class="last">
          <h4>The Twilight Saga: Eclipse</h4>
          <img src="/asset/images/1page-img4.jpg" alt="" />
          <p>Not Important</p>
          <div class="wrapper"><a href="#" class="link2"><span></span></a></div>
        </li>
        <li class="clear">&nbsp;</li>
      </ul>
    </div>
    <div id="footer">
      <div class="left">
        <div class="right">
          <div class="footerlink">
            <p class="lf"><a href="#"><img src="/asset/images/facebook.jpg" id="facebook" /></a><a href="#"><img src="/asset/images/twitter.jpg" id="twitter" /></a></p>
            <p class="rf">Copyright &copy; 2013 <b>UofT Theatre Inc.</b> - All Rights Reserved</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="movieSelection">
    <input type="hidden" id="theater_id" value="<?php echo $theater_id?>">
    <div id="showtime_label">Showtime for <?php echo $time?>
    </div>
    <div id='movieList'>
      <?php echo $movieList?>
    </div>
  </div>
</div>
<?php $this->load->view('footer');?>
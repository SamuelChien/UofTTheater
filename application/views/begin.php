<html>
  <head>
    <title>UofT Cinema</title>
    <link rel="StyleSheet" href="/asset/css/global.css" type="text/css" media="screen" />
    <link rel="StyleSheet" href="/asset/css/begin.css" type="text/css" media="screen" />
  </head>
  <body class="goodbye">
    <div class="fullPageContainer">
      <div id="container">
        <div id="page">
          <div id="contentHolder">
            <div class="region-wrapper first">
            <div class="goodbye-message">
              We have loved the many years of serving our loyal movie-goers.<br/>
              Thank you for experiencing the movies with us.<br/><br/><br/>
              Canada's #1 University Theatre is back again!<br/>
              With six dollars, we provide the equal knowledge and skill an Art Student will obtain in four years. <br /><br />
              "To be a winner, you first need to watch movies like one." - Prof. Frankestein<br/><br></br>
              For showtime information and tickets, please make your selection below:<br />
            </div>
            <form id="go" action="/main/home/" method="post">
              <div class="locations">
                <div class="label">Select your theatre:</div>
                <div class="dropdown">
                  <?php echo $list?>
                </div>
                <div><input type="submit" value="Submit"></div>
              </div>
            </form>
            <div>&nbsp;</div>
            <div class="line-separator"></div>
            <div class="centerdiv">
              <a class="button" href="/admin">Admin Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

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
</div>
<div id="content">
    <?php $this->load->view($renderPage);?>
</div>
<?php $this->load->view('footer');?>

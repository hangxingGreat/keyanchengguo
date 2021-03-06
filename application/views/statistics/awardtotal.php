<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>科研成果管理平台</title>
    <link href="<?=base_url()?>assets/logo.ico" rel="shortcut icon">
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet">
    <script src="<?=base_url()?>js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap-switch.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function()
    {

      $(window).scroll(function() {
        if($(window).scrollTop() > 100) {
          $('div.back_top').show();
        } else {
          $('div.back_top').hide();
        }
      });

      $('div.back_top').click(function() {
        $('html, body').animate({scrollTop: 0}, 500);
      });

      $("#back").click(function()
      {
        history.back();
      });
    });
    </script>
  </head>
  <body>

    <?php $this->load->view('template/navbar');?>

    <div class="container">
      <div class="row">
        <h3 class="text-center">信息统计</h3>
      </div>
      <div class="col-md-1">
        <a class="btn btn-success" id="back"><i class="fa fa-chevron-left"></i>&nbsp;后退</a>
      </div>
      <br>
      <hr/>

      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation"><a href="<?=site_url('statistics/index')?>">人员项目信息统计</a></li>
        <li role="presentation"><a href="<?=site_url('statistics/projectmoney')?>">项目金额统计</a></li>
        <li role="presentation" class="active"><a href="#">获奖次数统计</a></li>
        <li role="presentation"><a href="<?=site_url('statistics/fundsstat')?>">项目经费到账</a></li>
      </ul>
      <br/>
      <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading"><h4 class="text-center">人员及项目获奖统计信息</h4></div>
      <div class="panel-body">
        <p>下面是人员和项目的获奖次数统计，您可以<a href="<?=site_url('search/index')?>">查询</a>具体信息</p>
      </div>

      <table class="table table-striped table-hover">
        <tr>
          <td>人员编号</td>
          <td>姓名</td>
          <td>次数</td>
        </tr>
        <?php foreach($res as $item): ?>
        <tr>
          <td><?=$item->id?></td>
          <td><?=$item->name?></td>
          <td><?=$item->times?></td>
        </tr>
        <?php endforeach; ?>
      </table>
      <hr/>
      <table class="table table-striped table-hover">
        <tr>
          <td>项目编号</td>
          <td>名称</td>
          <td>次数</td>
        </tr>
        <?php foreach($resp as $item): ?>
        <tr>
          <td><?=$item->projectid?></td>
          <td><?=$item->name?></td>
          <td><?=$item->times?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  <div class="back_top">
    <div class="back_top_arrow"></div>
    <div class="back_top_stick"></div>
  </div>
    <?php $this->load->view('template/footer') ?>
    </div>
  </body>
</html>
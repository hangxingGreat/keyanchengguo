<script type="text/javascript">
    $(document).ready(function()
    {
      $("table tr:gt(0)").click(function()
      {
        var index = $(event.target).index(); //列索引
       var current_mode = $("#currentMode").text();
        if(current_mode == 0)
        {
          return;
        }else if(current_mode == 2)
        {
          var data = { projectid: $(event.target).parent().children().first().html() };
          $.post("<?=site_url('projectmanage/delete')?>",data,function(res,status)
          {
            $("#refresh_list").click();
            alert(res);
          });
          return;
        }else if(current_mode == 1)
        {
          if(index == 11) 
          {
            // 处理人员列表
            window.location="<?=site_url('projectmanage/fundslist')?>?number="+$(event.target).parent().children().first().html();
            return;
          }
          if(index == 12) 
          {
            // 处理人员列表
            window.location="<?=site_url('projectmanage/personlist')?>?number="+$(event.target).parent().children().first().html();
            return;
          }
          var colname = $(event.target).parent().parent().children().first().children().eq(index).html();//列名
          var value = $(event.target).text();
          var result = prompt("请输入新的"+colname+":",value);
          if(result == "" || result== null) //取消 输入为空 则不修改
            return;
          var opid = $(event.target).parent().children().first().html();
          if(index == 1)
          {
            var data={ projectid: opid, name: result, which: 'name'};
          }else if(index == 2)
          {
            var data={ projectid: opid, source: result, which: 'source' };
          }else if(index == 3)
          {
            var data={ projectid: opid, type: result, which: 'type'};
          }else if(index == 4)
          {
            var data={ projectid: opid, principal: result, which: 'principal'};
          }else if(index == 5)
          {
            var data={ projectid: opid, start: result, which: 'start'};
          }else if(index == 6)
          {
            var data={ projectid: opid, end: result, which: 'end'};
          }else if(index == 7)
          {
            var data={ projectid: opid, money: result, which: 'money'};
          }else if(index == 8)
          {
            var data={ projectid: opid, currency: result, which: 'currency'};
          }else if(index == 9)
          {
            var data={ projectid: opid, contract: result, which: 'contract'};
          }else if(index == 10)
          {
            var data={ projectid: opid, credit: result, which: 'credit'};
          }
          $.post("<?=site_url('projectmanage/modify')?>",data,function(res,status)
          {
            $("#refresh_list").click();
            alert(res);
          });
        }
      });

    });
</script>
  

      <table class="table table-striped table-hover">
         <tr>
          <td hidden>项目编号</td>
          <td>项目名称</td>
          <td>项目来源</td>
          <td>项目等级</td>
          <td>负责人</td>
          <td>开始时间</td>
          <td>结束时间</td>
          <td>合同额</td>
          <td>货币种类</td>
          <td>合同号</td>
          <td>经费卡号</td>
          <td>经费到款</td>
          <td>人员名单</td>
        </tr>
      <?php foreach($project as $item): ?>
        <tr>
          <td hidden><?=$item->projectid?></td>
          <td><?=$item->name?></td>
          <td><?php
          $res = $this->db->where('number',$item->source)->get('source')->row()->name;
          echo $res;
          ?></td>
          <td><?=$item->type?></td>
          <td><?php
          echo $this->db->where('id',$item->principal)->get('person')->row()->name;
          ?></td>
          <td><?=$item->start?></td>
          <td><?=$item->end?></td>
          <td><?=$item->money?></td>
          <td><?=$item->currency?></td>
          <td><?=$item->contract?></td>
          <td><?=$item->credit?></td>
          <td>
            <?php 
            // 获取人员名单 restrinct: <9
            $res = $this->db->where('projectid',$item->projectid)->get('funds')->result();
            $str = "";
            foreach($res as $item2)
            {
                $str .= $item2->payoff.",";
            }
            echo rtrim($str,',');
            ?>
          </td>
          <td>
            <?php 
            // 获取人员名单 restrinct: <9
            $res = $this->db->where('projectid',$item->projectid)->order_by('order')->get('projectlist')->result();
            $str = "";
            foreach($res as $item2)
            {
                $res = $this->db->where('id',$item2->id)->get('person');
                $str .= $res->row()->name.",";
            }
            echo rtrim($str,',');
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </table>
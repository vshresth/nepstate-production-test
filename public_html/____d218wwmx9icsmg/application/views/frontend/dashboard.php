<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>

<?php
$total_classifieds = $this->db->query("SELECT * FROM products WHERE payment_status = 'completed' AND uID = ".user_info()->id."")->num_rows();
$total_active_classifieds = $this->db->query("SELECT * FROM products WHERE payment_status = 'completed' AND uID = ".user_info()->id." AND expiry_date > '".date("Y-m-d")."'")->num_rows();
$total_expire_classifieds = $this->db->query("SELECT * FROM products WHERE payment_status = 'completed' AND uID = ".user_info()->id." AND expiry_date <= '".date("Y-m-d")."'")->num_rows();
$total_confession = $this->db->query("SELECT * FROM confessions WHERE type = 'confession' AND uID = ".user_info()->id." ")->num_rows();
$total_forum = $this->db->query("SELECT * FROM confessions WHERE type = 'forum' AND uID = ".user_info()->id." ")->num_rows();
$total_blogs = $this->db->query("SELECT * FROM blogs WHERE is_approved = 1 AND uID = ".user_info()->id." ")->num_rows();
$total_views = $this->db->query("SELECT * FROM views WHERE product_creator_id = ".user_info()->id." ")->num_rows();
$last_24hour_views = $this->db->where('product_creator_id = '.user_info()->id.'')->where('created_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')))->get('views')->num_rows();
$last_7day_views = $this->db->where('product_creator_id = '.user_info()->id.'')->where('created_at >=', date('Y-m-d', strtotime('-7 days')))->get('views')->num_rows();
$last_30day_views = $this->db->where('product_creator_id = '.user_info()->id.'')->where('created_at >=', date('Y-m-d', strtotime('-30 days')))->get('views')->num_rows();
$totalAds = $this->db->where('user_id', user_info()->id)->where('payment_status', 'completed')->get('products_ads')->num_rows();
$totalExpiredAds = $this->db->where('user_id', user_info()->id)->where('ad_expires <', date('Y-m-d'))->where('payment_status', 'completed')->get('products_ads')->num_rows();
$totalActiveAds = $this->db->where('user_id', user_info()->id)->where('ad_expires >', date('Y-m-d'))->where('payment_status', 'completed')->get('products_ads')->num_rows();
?>
                                        <?php include("common/siderbar.php"); ?>
                                        <div class="rtcl-MyAccount-content" style="background: transparent; padding: 0;">
                                           
                                            <div class="rtcl-user-info media">
                                                
                                                <div class="dashboard_stats">
                                                    <a href="<?php echo base_url();?>my-listings" class="stats_wrap">
                                                        <h2><?php echo $total_classifieds;?></h2>
                                                        <span>Total Classifieds</span>
                                                    </a>
                                                    <a href="<?php echo base_url();?>my-listings?type=active" class="stats_wrap">
                                                        <h2><?php echo $total_active_classifieds;?></h2>
                                                        <span>Active Classifieds</span>
                                                    </a>
                                                    <a href="<?php echo base_url();?>my-listings?type=expired" class="stats_wrap">
                                                        <h2><?php echo $total_expire_classifieds;?></h2>
                                                        <span>Expired Classifieds</span>
                                                    </a>
                                                    <a href="<?php echo base_url();?>my-blogs" class="stats_wrap">
                                                        <h2><?php echo $total_blogs; ?></h2>
                                                        <span>Total Blogs</span>
                                                    </a>
                                                    <a href="<?php echo base_url();?>my-forums" class="stats_wrap">
                                                        <h2><?php echo $total_forum; ?></h2>
                                                        <span>Total Forums</span>  
                                                    </a>
                                                    <a href="<?php echo base_url();?>my-confessions" class="stats_wrap">
                                                        <h2><?php echo $total_confession; ?></h2>
                                                        <span>Total Confessions</span>
                                                    </a>
                                                    <a href="<?php echo base_url();?>my-ads" class="stats_wrap">
                                                        <h2><?php echo $totalAds; ?></h2>
                                                        <span>Total Ads</span>
                                                    </a>
                                                    <a href="<?php echo base_url();?>my-ads?type=expired" class="stats_wrap">
                                                        <h2><?php echo $totalExpiredAds; ?></h2>
                                                        <span>Expired Ads</span>
                                                    </a>
                                                    <a href="<?php echo base_url();?>my-ads?type=active" class="stats_wrap">
                                                        <h2><?php echo $totalActiveAds; ?></h2>
                                                        <span>Active Ads</span>
                                                    </a>
                                                </div>


                                                <div class="stats_custom_full">
                                                    <div class="custom_stats_wrap">
                                                        <h4>
                                                            <i class="fa fa-eye"></i> Views
                                                        </h4>

                                                        <div class="views_custom_inner_flex">
                                                            <div class="wrap_section_inner">
                                                                <i class="fa fa-signal"></i>
                                                                <h3> <?php echo $last_24hour_views;?> </h3>
                                                                <span>Last 24 hours</span>
                                                            </div>
                                                            <div class="wrap_section_inner">
                                                                <i class="fa fa-signal"></i>
                                                                <h3><?php echo $last_7day_views; ?></h3>
                                                                <span>Last 7 days</span>
                                                            </div>
                                                            <div class="wrap_section_inner">
                                                                <i class="fa fa-signal"></i>
                                                                <h3><?php echo $last_30day_views; ?></h3>
                                                                <span>Last 30 days</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="custom_stats_wrap">
                                                        <h4>
                                                            <i class="fa fa-eye"></i> Unique Views
                                                        </h4>

                                                        <div class="views_custom_inner_flex">
                                                            <div class="wrap_section_inner">
                                                                <i class="fa fa-signal"></i>
                                                                <h3>333</h3>
                                                                <span>Last 24 hours</span>
                                                            </div>
                                                            <div class="wrap_section_inner">
                                                                <i class="fa fa-signal"></i>
                                                                <h3>1,999</h3>
                                                                <span>Last 7 days</span>
                                                            </div>
                                                            <div class="wrap_section_inner">
                                                                <i class="fa fa-signal"></i>
                                                                <h3>4,999</h3>
                                                                <span>Last 30 days</span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div style="padding: 10px; background:#fff">
                                                <div id="chart_div" style="height:400px"></div>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>                                  
                </main>
            </div>
        </div>
    </div>
</div>
<?php include("common/footer.php"); ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);



  function drawChart() {
    jQuery.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>Nepstate/ghraph_views',
                success: function(response) {
                    monthArr = JSON.parse(response);
                    monthArr.unshift(['Month', 'Views']);
                    console.log(monthArr)

                    var data = google.visualization.arrayToDataTable(
                                         monthArr
                  
                    );


    var options = {
      title: '',
      curveType: 'function',
       'width': '100%',
       'chartArea': {'width': '92%', 'height': '80%'},
       series: {
            0: { lineWidth: 2 },
            // 1: { lineWidth: 2 },
          },
          colors: ['#35C4B5', '#e28362'],
        vAxis: {
                viewWindow: {
                    min: 0,
                },
                gridlines: {color: '#ccc'}, 
            },
            
    //   legend: { position: 'bottom' }
    };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });

            
      
  }

</script>
<?php /* ?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Day');
      data.addColumn('number', '');
      data.addColumn('number', '');

      data.addRows([
        [1,  37.8, 80],
        [2,  30.9, 69],
        [3,  25.4,   57],
        [4,  11.7, 18],
        [5,  11.9, 17],
        [6,   8.8, 13],
        [7,   7.6, 12],
        [8,  12.3, 29],
        [9,  16.9, 42],
        [10, 12.8, 30],
        [11,  5.3,  7],
        [12,  6.6,  8],
        [13,  4.8,  6],
        [14,  4.2,  6],
      ]);

      var options = {
        chart: {
          title: '',
          subtitle: ''
        },
        
      };

      var chart = new google.charts.Line(document.getElementById('chart_div'));
      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
  <?php */ ?>
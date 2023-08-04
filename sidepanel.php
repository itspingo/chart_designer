       <center>
       <div style="width: 90%; ">
       		
     		<div class="row" >

     			<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
     				
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-3 py-4 mb-2  text-center rounded icon-box">
		            <i class="fa-solid fa-chart-bar"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Bar Chart</span>
        		</span>

        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="bar_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('bar_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span style="display: block;" id="bar-chart"></span>
											</span>
										</span>
									</span>

											  <script>
										var barChartOption = {
								          series: [{
								          data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
								        }],
								          chart: {
								          type: 'bar',
								          height: 350,
								          

								         
								        },
								        plotOptions: {
								          bar: {
								            borderRadius: 4,
								            horizontal: true,
								          }
								        },
								        dataLabels: {
								          enabled: false
								        },
								        xaxis: {
								          categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
								            'United States', 'China', 'Germany'
								          ],
								        }
								        };

									        var barchart = new ApexCharts(document.querySelector("#bar-chart"), barChartOption);
									        barchart.render();
							      		</script>
								</p>
        		</span>
     			</span>
     				

     				<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-4 py-4 mb-2  text-center rounded icon-box">
		            <i class="fa-solid fa-chart-line"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Line Chart</span>
        		</span>


        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="line_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('line_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span  id="line_basic" style="display: block;"></span>
											</span>
										</span>
									</span>

											  <script>
										var lineOption = {
									      chart: {
									        type: 'line',
									        height: 350,


									      },
									      series: [{
									        name: 'Sales',
									        data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
									      },
									      ],
									      xaxis: {
									        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
									      },
									      
									    };

									    var lineChart = new ApexCharts(document.querySelector("#line_basic"), lineOption);
									    lineChart.render();
							      		</script>
								</p>
        		</span>

     			</span>

     			<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-4 py-4 mb-2  text-center rounded icon-box">
		           <i class="fa-solid fa-chart-pie"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Pie Chart</span>
        		</span>


        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="pie_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('pie_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span  id="pie_basic" style="display: block;"></span>
											</span>
										</span>
									</span>

											  <script>
										 var pieOption = {
          series: [44, 55, 13, 43, 22],
          chart: {
         height:350,
          type: 'pie',
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

									    var pieChar = new ApexCharts(document.querySelector("#pie_basic"), pieOption);
									    pieChar.render();
							      		</script>
								</p>
        		</span>

     			</span>


   			<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-4 py-4 mb-2  text-center rounded icon-box">
		           <i class="fa-brands fa-osi"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Donut Chart</span>
        		</span>


        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="donut_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('donut_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span  id="donut_basic" style="display: block;"></span>
											</span>
										</span>
									</span>

	<script>
		var donutOption = {
			series: [44, 55, 13, 43, 22],
				chart: {
					height:350,
					type: 'donut',
				},
			labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}]
		};

		var donutChart = new ApexCharts(document.querySelector("#donut_basic"), donutOption);
		donutChart.render();
	</script>
								</p>
        		</span>

     			</span>




     		<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-4 py-4 mb-2  text-center rounded icon-box">
		           <i class="fas fa-chart-area"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Area Chart</span>
        		</span>


        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="area_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('area_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span  id="area_basic" style="display: block;"></span>
											</span>
										</span>
									</span>

											  <script>
										var lineOption = {
									      chart: {
									        type: 'area',
									        height: 350,


									      },
									      series: [{
									        name: 'Sales',
									        data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
									      },
									      ],
									      xaxis: {
									        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
									      },
									      
									    };

									    var lineChart = new ApexCharts(document.querySelector("#area_basic"), lineOption);
									    lineChart.render();
							      		</script>
								</p>
        		</span>

     			</span>		



     			<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-4 py-4 mb-2  text-center rounded icon-box">
		           <i class="fa-solid fa-dharmachakra"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Radar Chart</span>
        		</span>


        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="radar_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('radar_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span  id="radar_basic" style="display: block;"></span>
											</span>
										</span>
									</span>

											  <script>
										var radarOption = {
											 title: { text: 'Radar Chart', },
									      chart: {
									        type: 'radar',
									        height: 350,


									      },
									      series: [{
									        name: 'Sales',
									        data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
									      },
									      ],
									      xaxis: {
									        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
									      },
									      
									    };

									    var RadarOption = new ApexCharts(document.querySelector("#radar_basic"), radarOption);
									    RadarOption.render();
							      		</script>
								</p>
        		</span>

     			</span>	





<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-4 py-4 mb-2  text-center rounded icon-box">
		           <i class="bi bi-ui-radios-grid"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Scattered Chart</span>
        		</span>


        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="scattered_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('scattered_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span  id="scattered_basic" style="display: block;"></span>
											</span>
										</span>
									</span>

											  <script>
										var scatteredOption = {
									      chart: {

									        type: 'scatter',
									        height: 350,

									      },

									      series: [{
									        name: 'Sales',
									        data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
									      },],

									      xaxis: {
									        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
									      },

									       markers: {

	 	  											show: true ,
         										size: 20,
          									
          									},

									    };

									    var scatteredChart = new ApexCharts(document.querySelector("#scattered_basic"), scatteredOption);
									    scatteredChart.render();
							      		</script>
								</p>
        		</span>

     			</span>	






<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-4 py-4 mb-2  text-center rounded icon-box">
		           <i class="bi bi-ui-radios-grid"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Bubble Chart</span>
        		</span>


        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="bubble_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('bubble_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span  id="bubble_basic" style="display: block;"></span>
											</span>
										</span>
									</span>

											  <script>
function generateData(startTime, count, options) {
  const data = [];

  // Generate random data points for the specified count
  for (let i = 0; i < count; i++) {
    const xValue = Math.floor(Math.random() * (options.max - options.min + 1)) + options.min; // Add a day to the startTime for each data point
    const yValue = Math.floor(Math.random() * (options.max - options.min + 1)) + options.min;
    const zValue = Math.floor(Math.random() * (options.max - options.min + 1)) + options.min;

    data.push({
      x: xValue,
      y: yValue,
      z: zValue
    });
  }

  return data;
}

     var bubbleOption = {
          series: [{
          name: 'Bubble1',
          data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 60
          })
        },
        {
          name: 'Bubble2',
          data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 60
          })
        },
        {
          name: 'Bubble3',
          data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 60
          })
        },
        {
          name: 'Bubble4',
          data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 60
          })
        }],
          chart: {
            height: 400,
            type: 'bubble',
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            opacity: 0.8
        },
        title: {
            text: 'Simple Bubble Chart'
        },
        xaxis: {
            tickAmount: 12,
            type: 'category',
        },
        yaxis: {
            max: 70
        }
        };

        var bubbleChart = new ApexCharts(document.querySelector("#bubble_basic"), bubbleOption);
        bubbleChart.render();

			</script>
		</p>
	</span>
</span>	










<span class=" col-6  " draggable="true" style="padding-right:0px" id="<?php $itmid = rand(1,99999); echo "iconItem_".$itmid; ?>" >
	       		<span class="d-block text-body-emphasis text-decoration-none " >
		          <span class="d-block px-4 py-4 mb-2  text-center rounded icon-box">
		           <i class="fa-regular fa-circle"></i>
		          </span>
		          <span class="d-block name text-muted text-decoration-none text-center  pb-2">Radial Chart</span>
        		</span>


        		<span id="<?php echo 'actualItem_'.$itmid; ?>" style="display: none;">
        				<p name="radial_basic" id="<?php echo $itmid; ?>" draggable="true"    class="list-group-item child-item"  data-item-seq="0" >
									<span>
										<span class="row">						
											<span id="<?php echo 'controls_'.$itmid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;display:none;" align="right" >
												<a style="cursor:pointer;color:blue;"  onClick="showattribs('radial_basic', <?php echo $itmid; ?>)" ><i class="bi bi-gear"></i></a>	
												<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $itmid; ?>)" ><i class="bi bi-trash"></i></a>
												
											</span>
										</span>
										<span class="row">
											<span class="col-12 float-left" id="<?php echo 'label_'.$itmid; ?>"  >
												<span  id="radial_basic" style="display: block;"></span>
											</span>
										</span>
									</span>

			<script>

				     var radialOption = {
          series: [44, 55, 67, 83],
          chart: {
          height: 350,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            dataLabels: {
              name: {
                fontSize: '22px',
              },
              value: {
                fontSize: '16px',
              },
              total: {
                show: true,
                label: 'Total',
                formatter: function (w) {
                  // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                  return 249
                }
              }
            }
          }
        },
        labels: ['Apples', 'Oranges', 'Bananas', 'Berries'],
        };

        var radialChart = new ApexCharts(document.querySelector("#radial_basic"), radialOption);
        radialChart.render();
    

			</script>
		</p>
	</span>
</span>	












     		</div>

			
		

		


       </div>    
       </center>

<br>
			


			



			
			




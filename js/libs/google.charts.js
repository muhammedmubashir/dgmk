//Google charts

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
	  
      // PIE chart
	  //----------------------------------------------------------
      var data_p = new google.visualization.DataTable();
      
	  
      data_p.addColumn('string', 'Topping');
      data_p.addColumn('number', 'Slices');
      data_p.addRows([
        ['Themeforest', 5000],
        ['Activeden', 11231],
        ['Audio Jungle', 43801], 
        ['Videohive', 12188], 
        ['Graphicriver', 33399], 
        ['3D Ocean', 3747],
        ['Codecanyon', 2079],
        ['Tutorials', 693]
      ]);
	
	   // Set chart options
      var options_p = {'title':'Items uploaded on marketplaces in the last 5 years', 'width':600,  'height':300,	 fontName: 'Helvetica',	 legend: 'right',  colors: ['#7d5e3b', '#f18726', '#93a92f', '#e7a30f', '#006eb3', '#860b26', '#c23917', '#ee9900'],  is3D: true, backgroundColor: 'transparent'};
      var chart = new google.visualization.PieChart(document.getElementById('p_chart_div'));	
	  chart.draw(data_p, options_p);
		
		//Bar Graph
	  //------------------------------------------------------------------
		var data_b = new google.visualization.DataTable();
		data_b.addColumn('string', 'Year');
        data_b.addColumn('number', 'Theme forest');
        data_b.addColumn('number', 'Activeden');
        data_b.addColumn('number', 'Audio Jungle');
        data_b.addRows(4);
        data_b.setValue(0, 0, '2008');
        data_b.setValue(0, 1, 1980);
        data_b.setValue(0, 2, 4009);
        data_b.setValue(0, 3, 11020);
        data_b.setValue(1, 0, '2009');
        data_b.setValue(1, 1, 2309);
        data_b.setValue(1, 2, 7090);
        data_b.setValue(1, 3, 15609);
        data_b.setValue(2, 0, '2010');
        data_b.setValue(2, 1, 3504);
        data_b.setValue(2, 2, 9930);
        data_b.setValue(2, 3, 29930);
        data_b.setValue(3, 0, '2011');
        data_b.setValue(3, 1, 5000);
        data_b.setValue(3, 2, 11231);
        data_b.setValue(3, 3, 43801);
		
	// Set bar graph options		
		var options_b = {'title':'Items upload comparison on the market place',  'width':600, 'height':300, fontName: 'Helvetica',	 legend: 'right', colors: ['#7d5e3b', '#f18726', '#93a92f'], 			 hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}, backgroundColor: 'transparent'};
	  var b_graph = new google.visualization.ColumnChart(document.getElementById('b_graph_div'));
      b_graph.draw(data_b, options_b);
	  
	 //Line Graph using same data as bar graph
	 //------------------------------------------------------------------
	var l_graph = new google.visualization.LineChart(document.getElementById('b_line_div'));
      l_graph.draw(data_b, options_b);
	  
    }


	
	//world map
	//----------------------------------------------------------
	google.load('visualization', '1', {'packages': ['geochart']});
   google.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
      var data = new google.visualization.DataTable();
      data.addRows(10);
      data.addColumn('string', 'Country');
      data.addColumn('number', 'Authors');
      data.setValue(0, 0, 'Germany');
      data.setValue(0, 1, 2530);
      data.setValue(1, 0, 'United States');
      data.setValue(1, 1, 12241);
      data.setValue(2, 0, 'Brazil');
      data.setValue(2, 1, 4331);
      data.setValue(3, 0, 'Canada');
      data.setValue(3, 1, 588);
      data.setValue(4, 0, 'France');
      data.setValue(4, 1, 3502);
      data.setValue(5, 0, 'United Kingdom');
      data.setValue(5, 1, 7123);      
	  data.setValue(6, 0, 'Australia');
      data.setValue(6, 1, 9332);	 
	  data.setValue(7, 0, 'South Africa');
      data.setValue(7, 1, 1233);	  
	  data.setValue(8, 0, 'Russia');
      data.setValue(8, 1, 3234);	  
	  data.setValue(9, 0, 'India');
      data.setValue(9, 1, 5456);	  
	  data.setValue(9, 0, 'China');
      data.setValue(9, 1, 2221);

      var options = {'width':600, 'height':300, colors: ['#7d5e3b', '#f18726', '#93a92f', '#e7a30f'], backgroundColor: 'transparent'};

      var container = document.getElementById('w_map_div');
      var geochart = new google.visualization.GeoChart(container);
      geochart.draw(data, options);
  };
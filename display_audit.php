<html>
  <head>
    <script type="text/javascript" src="renderjson.js"></script>
    <SCRIPT LANGUAGE=JavaScript>
    function get_query_argument(name, href) {
    
      href = (href) || window.location.href;
      name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    
      var regexS = "[\\?&]"+name+"=([^&#]*)";
      var regex = new RegExp( regexS );
      var results = regex.exec(href);
    
      return (results == null ? "" : results[1]);
    };
    function reload_new_search() {
      var url = "index.php";
      location.href=url;
    };
    </SCRIPT>  
  </head>
    
  <body>
    <?php
      // Get args passed.
      $cookbook=$_GET['cookbook'];
      $recipes=$_GET['recipes'];
      $env = $_GET['env'];
      $show_list = $_GET['show'];
      $dir = getcwd();
      $opts = '';
      $title = 'Cookbook usage counts';
      
      if ($recipes == "on") {
        $opts = $opts." -r";
        $title = $title . " by recipe";
      };
   
      if ($show_list == "on") {
        $opts = $opts." -s";
        $title = $title . " with server list";
      };

      if ($env <> 'All') {
        $opts = $opts." -E ". $env;
        $title = $title . " in ". $env;
      };

      if ($cookbook <> 'All') {
        $opts = $opts." ".$cookbook;
        $title = $title . " for ". $cookbook;
      } else {
        $title = $title . " for all cookbooks";
      }
  
      exec("/usr/bin/knife audit -t " . $opts . " -u readonly -k " . $dir . "/.chef/readonly.pem -c " . $dir . "/.chef/knife.rb|grep -v 'Cookbook audit totals'", $auditout, $retval );
      $str_obj = implode("</BR>", $auditout);

      print "<h1>". $title. "  ";
      print "<INPUT TYPE=Button VALUE='New Search' Onclick='reload_new_search()'></h1>";
      if ( $retval <> 0 ) {
        print "<p>Error ". $retval."</p>"; 
      }; 

      print '<div id="output">';
      print $str_obj;
      print '</div>'
    ?>
  </body>
</html>

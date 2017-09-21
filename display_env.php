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
  </head
    
  <body>
    <?php
      // Get args passed.
      $env_input=$_GET['Environment'];
      $dir = getcwd();
      exec("/usr/bin/knife environment show " . $env_input . " -F json -s https://cs1chl001.classifiedventures.com:443 -u readonly -k " . $dir . "/.chef/readonly.pem -c " . $dir . "/.chef/knife.rb|./jq '{ name: .name, cookbook_versions: .cookbook_versions, attr: ( .default_attributes + .override_attributes)}'", $jsonout, $retval );
      $str_obj = implode("", $jsonout);

      print "<h1>Attribute Display for ". $env_input . "  ";
      print "<INPUT TYPE=Button VALUE='New Search' Onclick='reload_new_search()'></h1>";
      if ( $retval <> 0 ) {
        print "<p>Error ". $retval."</p>"; 
      } 

      echo '<pre><div id="output"></div></pre>';
      echo '<script>document.getElementById("output").appendChild(renderjson.set_show_to_level(1).set_icons("+", "-")('. $str_obj . '));</script>';
    ?>
  </body>
</html>

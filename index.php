<html>
  <body>
    <h1>Display Chef Data</h1>
    <h2>Environment Attributes</h2>
    <form action="display_env.php" method="get">
      Environment:
      <select name="Environment">
        <?php 
          $dir = getcwd();
          exec("/usr/bin/knife environment list -u readonly -k " . $dir . "/.chef/readonly.pem -c " . $dir . "/.chef/knife.rb", $envlist, $retval );
          foreach ( $envlist as $env) { 
            if ($env != "_default") {
              print "<option value=". $env .">".$env."</option>";
            }
          }
        ?> 
      </select>
      <input type="submit" value="View Env">
    </form>
    <h2>Node Attributes</h2>
    <form action="display_node.php" method="get">
      Node:
      <input type="text" name="nodename"> &nbsp; &nbsp;
      <input type="submit" value="View Node">
    </form>
    <h2>Cookbook Usage counts</h2>
    <form action="display_audit.php" method="get"> 
      cookbook to view:
      <select name="cookbook">
        <?php 
          exec("/usr/bin/knife cookbook list -u readonly -k " . $dir . "/.chef/readonly.pem -c " . $dir . "/.chef/knife.rb|awk '{ print $1 }'", $cblist, $retval );
          foreach ( $cblist as $cb) { 
            print "<option value=". $cb .">".$cb."</option>";
          }
        ?> 
      </select>
      </BR>Split by recipe: 
      <input type="checkbox" name="recipes">
      </BR>Show node lists:
      <input type="checkbox" name="show">
      </BR>Environment:
      <select name="env">
        <option value="All">All</option>
        <?php 
          foreach ( $envlist as $env) { 
            if ($env != "_default") {
              print "<option value=". $env .">".$env."</option>";
            }
          }
        ?> 
      </select>
      <input type="submit" value="View Audit">
      This may take some time, please be patient
    </form>
  </body>
</html>

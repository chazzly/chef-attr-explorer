Chef Attribute Explorer
=======================
This is a simple php web page which uses the read-only chef account to pull attribute information, transform it with jq, and then uses renderjson.js to display the resulting object.

Requirements
============
The following are required to be provided outside of this repo.  
- php support
- Server configuration updated in '.chef/knife.rb'
- Chef certificate placed in the '.chef/trusted_certificates' directory.
- Read only account (username: readonly) configured on Chef server.
- Pem file associated with readonly account named '.chef/readonly.pem'

Features
========
- View Environment
- View node 
- View Cookbook usage (pulls output from the knife audit plugin of knife).




Licenses
========

attribue explorer
-----------------
copyright (C) 2015 Cars.com



renderjson.js
-------------
License: ISC

Copyright © 2013-2014 David Caldwell <david@porkrind.org>

https://github.com/caldwell/renderjson

Permission to use, copy, modify, and/or distribute this software for any purpose with or without fee is hereby granted, provided that the above copyright notice and this permission notice appear in all copies.



jq
----
jq is copyright (C) 2012 Stephen Dolan

https://stedolan.github.io/jq/

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

knife audit plugin
------------------

Authors:: J.B. Zimmerman

Copyright:: Copyright (c) 2009-2011 J.B. Zimmerman

License:: Apache License, Version 2.0

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0
Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.

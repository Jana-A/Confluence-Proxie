# Confluence-Proxie

Display PHP script output in a Confluence HTML-Include Macro.

Requirement: Apache server accepting HTTP requests

\[sudo iptables -L\]

\[sudo iptables -I INPUT 3 -p tcp -m state --state NEW -m tcp --dport ssh -j ACCEPT\]

Apache

&nbsp;&nbsp;config: /etc/httpd/conf/httpd.conf (root dir: /var/www/html/)
  
&nbsp;&nbsp;sudo apachectl restart
    
&nbsp;&nbsp;sudo apachectl restart

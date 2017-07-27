# Confluence-Proxie

Display PHP script output in a Confluence HTML-Include Macro.

Requirement: Apache server accepting HTTP requests
\[sudo iptables -L\]
\[sudo iptables -I INPUT 3 -p tcp -m state --state NEW -m tcp --dport ssh -j ACCEPT\]
Apache
  config: /etc/httpd/conf/httpd.conf (root dir: /var/www/html/)
  commands:
    sudo apachectl restart
    sudo apachectl restart

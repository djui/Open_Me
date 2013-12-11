netsh interface ipv4 set subinterface "Internet" mtu=1499 store=persistent
netsh interface tcp set global ecncapability=enabled
netsh int tcp set global rss=enabled
netsh int tcp set heuristics disabled
netsh int tcp set global congestionprovider=ctcp
sc.exe config "AudioSrv" start= disabled
sc.exe config "wscsvc" start= disabled
sc.exe config "CscService" start= disabled
sc.exe config "WinDefend" start= disabled


bcdedit /set {default} recoveryenabled No
fsutil behavior query disabledeletenotify
chkntfs/t:4
powercfg.exe /hibernate off

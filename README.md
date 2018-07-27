# 服务端启动caddy

> caddy -quic -conf Caddyfile

# quic 客户端测试反向代理

> ./quic_client --host=10.0.80.160 --port=8800 --v=1 https://quic.clemente.io/wiki/index.php/首页



使用浏览器测试需要先开启支持quic协议

> chromium-browser --user-data-dir=/tmp/chrome --no-proxy-server --enable-quic --origin-to-force-quic-on=quic.clemente.io:443 --host-resolver-rules='MAP quic.clemente.io:443 127.0.0.1:8800' https://quic.clemente.io


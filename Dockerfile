FROM ubuntu:trusty
ENV PATH /usr/local/bin:$PATH

COPY caddy /usr/bin 
COPY fullchain.pem /root
COPY privkey.pem /root
RUN mkdir -p /root/html
COPY html /root/html
COPY Caddyfile /root

CMD ["caddy", "-quic", "-conf", "/root/Caddyfile"]

<h1>
    <img src="https://console.trustocean.com/templates/lagom/assets/img/logo/logo_big.svg" style="width: 300px;">
    <span style="font-size:28px">ACME SERVER</span>
</h1>

一个 [TrustOcean API](https://api.trustocean.com/?from=github-trustocean-acme) 转 [ACME API](https://tools.ietf.org/html/draft-ietf-acme-acme-09) 的项目。

客户端：[trustocean/acme-client](https://github.com/trustocean/acme-client/)


## 安装

```bash
git clone https://github.com/trustocean/acme-server.git ./
cp .env.example .env
composer install
php artisan key:generate
php artisan serve
```
修改 `.env` 中的 TRUSTOCEAN_USERNAME 和 TRUSTOCEAN_PASSWORD 为你本人的 trustocean 的账号。

然后将你的 acme 客户端的 api endpoint 修改成 localhost，即可正常使用。


## 完成度

- [x] 账户注册
- [x] 证书下单
- [x] 证书域名验证
- [x] 证书签发
- [ ] 证书撤销


## License

MIT

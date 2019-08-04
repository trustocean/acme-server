<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ACME.dev.trustocean.com</title>

        <!-- Fonts -->
        <link href="https://lib.sinaapp.com/js/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                font-family: sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                width: 500px;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                display: inline-block;
                margin-top: 30px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            div, pre, h2 {
                width: 100%;
            }
            pre, h2, .desc-content {
                max-width: 800px;
                display: inline-block;
            }

            #trustoceanseal {
                width: 98px;
                height: 36px;
            }
        </style>
    </head>
    <body class="container">
        <div class="position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="https://console.trustocean.com/templates/lagom/assets/img/logo/logo_big.svg" style="width: 40%"/>
                    <span style="width:60%">ACME</span>
                </div>
                <p>
                    <a class="github-button" href="https://github.com/trustocean" data-size="large" data-show-count="true" aria-label="Follow @trustocean on GitHub">Follow @trustocean</a>
                    <a class="github-button" href="https://github.com/trustocean/acme-server" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star trustocean/acme-client on GitHub">Star</a>
                </p>
                <h2 class="text-left">安装使用 <small>目前不支持其他 ACME 客户端</small></h2><br/>
                <pre class="text-left">
wget https://git.io/acmephp -O ~/acme
wget https://git.io/acmephp.yml -O ~/acmephp.yml

#修改权限为可执行
chmod -R 755 ~/acme

#修改你的域名和域名挑战信息 (见"#配置"说明)
vim ~/acmephp.yml

#申请证书
~/acme run ~/acmephp.yml -v --server={{route('acme.directory')}}
</pre>
                <h2 class="text-left">配置 <small>配置 acmephp.yml 说明</small></h2><br/>
                <pre class="text-left">
contact_email: londry@qiaoke.com #联系邮箱

certificates:
  # DNSPod 验证 key 需要在 https://console.cloud.tencent.com/cam/capi 获取访问秘钥
  - domain: "*.domain1.com" #主域名，支持单域名、通配。但通配域名必须加双引号
    subject_alternative_names:
      - "*.domain2.com" #额外域名，证书的DNS字段，可以支持通配
    solver:
      name: dnspod #支持 http-file、gandi、dnspod、aliyun
      secret_id: *** #额外参数，不同的 solver 需要的参数不一样。
      secret_key: ***


  # AliyunDNS 验证 key 需要在 https://usercenter.console.aliyun.com/#/manage/ak 获取访问秘钥
  - domain: "*.domain1.com" #主域名，支持单域名、通配。但通配域名必须加双引号
    subject_alternative_names:
      - "*.domain2.com" #额外域名，证书的DNS字段，可以支持通配
    solver:
      name: dnspod #支持 http-file、gandi、dnspod、aliyun
      secret_id: *** #额外参数，不同的 solver 需要的参数不一样。
      secret_key: ***

  # HTTP 文件验证
  - domain: www.domain3.com
    subject_alternative_names:
      - www2.domain3.com
    solver:
      name: http-file # http文件验证
      adapter: sftp # http文件验证的适配器，由flysystem实现。支持sftp、ftp、local、
      root: /Project/nginx/www.domain3.com/public # web根目录
      host: www.domain3.com # 服务器主机。如果域名走了CDN，务必改成源IP
      username: root # sftp的登陆名
      privateKey: /Users/londry/.ssh/id_rsa # sftp登陆秘钥

  # 申请成功后自动部署到 CDN 等服务, 或者 FTP/SFTP 推送到服务器
  - domain: www.domain3.com
    subject_alternative_names:
      - www2.domain3.com
    solver:
      //...
    install:
      # 安装行为 action支持 install_aws_elb、 install_aws_elbv2、 install_aliyun_cdn、 install_aliyun_waf、push_ftp、push_sftp
      - action: install_aliyun_cdn
        region: cn-hangzhou
        domain: www.domain3.com
        accessKeyId: ***
        accessKeySecret: ***
      - action: install_aliyun_waf
        region: eu-west-1
        instanceId: waf-instanceid
        domain: www2.domain3.com
        accessKeyId: ***
        accessKeySecret: ***
</pre>
            </div>
        </div>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>
</html>

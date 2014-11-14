# Laravel 路由管理

![预览](https://github.com/friparia/lrm/blob/master/rt.jpg)
## 安装

首先， 在`composer.json`文件的`require`中加入如下一行：
    
    "friparia/lrm": "dev-master"

然后， 在你的`app/config/app.php`中服务提供者(Service Provider)中添加如下一行：
    
    "Friparia\Lrm\LrmServiceProvider",

最后， 你要确保`routes.php`的访问权限使其能够被我们的页面正常修改

记得在上线后将你的`routes.php`文件改回644权限

## 使用方法

直接通过浏览器访问即可，如下

    "www.example.com/public/lrm"

然后你就可以来管理你的路由了~

## 问题

这个插件仍然在开发中，作者在考研所以到2015年才能有大的更新，欢迎大家一起来修改这个插件。同时，这个插件只支持部分方法`get`, `post`, `put`, `patch`, `delete`，并且能够写回调函数。

## 开发中

- [ ] 支持 `resource()`, `controller()` 方法

- [ ] 支持过滤器

- [ ] 支持组管理

- [ ] 支持编辑


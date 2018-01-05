## 说明
基于ThinkPHP5.0 开发的简单内容管理系统，后台集成权限角色管理，基本的内容录入管理，后台菜单自定义灵活扩展，功能扩展方便，可作为任何系统后台管理

##后台框架
后台框架，采用phpwind后台框架和layui前端框架修改而来。

##权限管理
权限管理系统采用Rbac基于用户角色对节点认证，将TP的模块控制器方法作为基本节点，同时权限节点也是后台菜单，后台菜单完全自定义灵活扩展控制。
功能特性：
  

> 1，是对规则进行认证，不是对节点进行认证。用户可以把节点当作规则名称实现对节点进行认证。
>        $auth=new Auth();  $auth->check('规则名称','用户id')
>   2，可以同时对多条规则进行认证，并设置多条规则的关系（or或者and）
>        $auth=new Auth();  $auth->check('规则1,规则2','用户id','and') 
>        第三个参数为and时表示，用户需要同时具有规则1和规则2的权限。 当第三个参数为or时，表示用户值需要具备其中一个条件即可。默认为or
>   3，一个用户可以属于多个用户组(think_auth_group_access表 定义了用户所属用户组)。我们需要设置每个用户组拥有哪些规则(think_auth_group 定义了用户组权限)
>   
>   4，支持规则表达式。
>        在think_auth_rule 表中定义一条规则时，如果type为1， condition字段就可以定义规则表达式。 如定义{score}>5  and {score}<100  表示用户的分数在5-100之间时这条规则才会通过。

##权限节点数据库


> -- ----------------------------
> -- think_auth_rule，规则表，
> -- id:主键，name：规则唯一标识, title：规则中文名称 status 状态：为1正常，为0禁用，condition：规则表达式，为空表示存在就验证，不为空表示按照条件验证
```
-- ----------------------------
 DROP TABLE IF EXISTS `think_auth_rule`;
CREATE TABLE `think_auth_rule` (  
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,  
    `name` char(80) NOT NULL DEFAULT '',  
    `title` char(20) NOT NULL DEFAULT '',  
    `type` tinyint(1) NOT NULL DEFAULT '1',    
    `status` tinyint(1) NOT NULL DEFAULT '1',  
    `condition` char(100) NOT NULL DEFAULT '',  # 规则附件条件,满足附加条件的规则,才认为是有效的规则
    PRIMARY KEY (`id`),  
    UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- ----------------------------
```
> -- think_auth_group 用户组表， 
> -- id：主键， title:用户组中文名称， rules：用户组拥有的规则id， 多个规则","隔开，status 状态：为1正常，为0禁用
```
-- ----------------------------
 DROP TABLE IF EXISTS `think_auth_group`;
CREATE TABLE `think_auth_group` ( 
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT, 
    `title` char(100) NOT NULL DEFAULT '', 
    `status` tinyint(1) NOT NULL DEFAULT '1', 
    `rules` char(80) NOT NULL DEFAULT '', 
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- ----------------------------
```

> -- think_auth_group_access 用户组明细表
> -- uid:用户id，group_id：用户组id
```
-- ----------------------------
DROP TABLE IF EXISTS `think_auth_group_access`;
CREATE TABLE `think_auth_group_access` (  
    `uid` mediumint(8) unsigned NOT NULL,  
    `group_id` mediumint(8) unsigned NOT NULL, 
    UNIQUE KEY `uid_group_id` (`uid`,`group_id`),  
    KEY `uid` (`uid`), 
    KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
```

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─common             公共模块目录（可以更改）
│  ├─admin              后台模块
│  │  ├─config.php      模块配置文件
│  │  ├─common.php      模块函数文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─view            视图目录
│  │  └─ ...            更多类库目录
│  ├─api                接口模块
│  │  ├─config.php      
│  │  ├─common.php      
│  │  ├─controller      
│  │  ├─model           
│  │  ├─view            
│  │  └─ ...            
│  ├─index              前台模块
│  │  ├─config.php      
│  │  ├─common.php      
│  │  ├─controller      
│  │  ├─model           
│  │  ├─view            
│  │  └─ ...            
│  ├─install            系统安装模块
│  │  ├─config.php      
│  │  ├─common.php      
│  │  ├─controller      
│  │  ├─model           
│  │  ├─view            
│  │  └─ ...            
│  ├─command.php        命令行工具配置文件
│  ├─common.php         公共函数文件
│  ├─config.php         公共配置文件
│  ├─route.php          路由配置文件
│  ├─tags.php           应用行为扩展定义文件
│  └─database.php       数据库配置文件
│
├─public                WEB目录（对外访问目录）    
│  │  ├─static          静态文件 
│  │  │  ├─admin
│  │  │  ├─install
│  │  │  ├─....
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─src              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
├─1.sql                 数据库文件




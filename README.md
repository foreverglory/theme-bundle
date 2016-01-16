ThemeBundle
===========

Symfony2 Bundle for theme choice, you can set theme's dir, theme's default or by class of set current theme.
设定主题目录，默认主题或者通过类设定当前主题
自定义主题目录、模板文件规则

Introduction
------------

### Composer

Add to `composer.json` in your project to `require` section:

```json
{
    "foreverglory/theme-bundle": "~2.0"
}
```
### Add this bundle to your application's kernel

```php
//app/AppKernel.php
public function registerBundles()
{
    return array(
         // ...
        new Glory\ThemeBundle\GloryThemeBundle(),
        // ...
    );
}
```

### Conﬁgure service in your YAML configuration
```yaml
#app/conﬁg/conﬁg.yml
glory_theme:
    default: default        #default theme, Allow Null or One of theme list. （默认主题，允许为空或者下面配置中的一个主题）
    switch: ~               #switch theme, class, if exist use class->getChecked(); （切换主题，类，如果存在，则优先取该类所选择的主题，参考） see: Glory/ThemeBundle/Switcher/*, you can write class
    theme:                  #theme list
        default:            #theme name, theme dir
            dir: %kernel.root_dir%/Resources/desktop
            format: ~       #todo
        mobile:
            dir: %kernel.root_dir%/Resources/mobile
```

PHP examples
------------

``` php
$themeManager = $container->get('glory_theme.manager');
$themeManager->getThemes();
$themeManager->getCurrentTheme();
$themeManager->getDefaultTheme();
```

Todo
------------
theme path format 主题路径格式化
like 
```
app/Resources/TwigBundle/views/Exception/layout.html.twig

app/Resources       ==  theme dir
TwigBundle          ==  Bundle->getName()
views/Exception     ==  template path
layout.html.twig    ==  template file
```
I want format this Path. 

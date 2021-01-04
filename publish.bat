@echo off
@echo Please wait a moment for packing...

rem 设置目录变量
set dist=%cd%\release
set view=%dist%\view

rem 判断是否存在dist目录
if not exist %dist% md %dist%

rem 复制app目录到dist目录下
@xcopy %cd%\app %dist% /s/e/h/c/y

rem 判断是否存在view目录 不存在则创建
if not exist %view% md %view%

echo The Vue-cli packing... Please wait a moment...

rem 打开目录
cd %cd%\view

rem 执行打包操作 如果使用npm请替换为 npm run build
call yarn build

rem 返回主目录
cd ..

rem 复制vue-cli打包文件
@xcopy %cd%\view\dist\static %dist%\public\static /s/h/c/y
@xcopy %cd%\view\dist\index.html %view% /y
@xcopy %cd%\view\dist\favicon.* %dist%\public /y

rem 讲集合目录压缩
echo Package successfully


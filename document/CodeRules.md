## クラスの命名規則 
- クラス名は大文字で始める
- クラス名はアッパーキャメルケースで記述する（Test）

### コントローラ
- コントローラ名は「Controller」で終わる
- {リソース名}{メソッド名}Controllerの形式で記述する

#### リソース名
- リソース名は複数形で記述する

#### メソッド名 
- GetList　リソースの一覧画面取得
- GetCreate　リソース作成画面の取得
- Post　リソース登録
- GetDetail　リソース詳細画面取得
- Put　リソースの更新
- Delete　リソースの削除

#### 命名の例
- UsersGetListController
- UsersGetCreateController 
- UsersPostController 
- UsersGetDetailController 
- UsersPutController 
- UsersDeleteController

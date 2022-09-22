<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Userlevel;
use App\Models\Userdetail;
use App\Models\ArticleUserLink;
use Illuminate\Database\Seeder;
use App\Models\PublishPermission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // userlevel table
        Userlevel::create([
            'level' => 'admin',
            'desc'  => ''
        ]);

        Userlevel::create([
            'level' => 'editor',
            'desc'  => ''
        ]);

        Userlevel::create([
            'level' => 'public',
            'desc'  => ''
        ]);

        // user table
        User::create([
            'name'          => 'Teguh Wijoseno', // id = 1
            'email'         => 'mr.wijoseno@gmail.com',
            'password'      => Hash::make('123')
        ]);

        User::create([
            'name'          => 'Puguh Wijanarko', // id = 2
            'email'         => 'puguh@gmail.com',
            'password'      => Hash::make('123')
        ]);
     
        User::create([
            'name'          => 'Andri Lubis', // id = 3
            'email'         => 'andri@gmail.com',
            'password'      => Hash::make('123')
        ]);

        User::create([
            'name'          => 'Anton Prafanto', // id = 4
            'email'         => 'anton@gmail.com',
            'password'      => Hash::make('123')
        ]);

        // userdetails table
        Userdetail::create([
            'enablestatus'  => '1',
            'user_id'       => '1',
            'userlevel_id'  => '1',
            'photo'         => '',
            'telp'          => '+6287888570877',
            'birth'         => '1988-12-23',
            'address'       => 'Jl. Sasak Batu no.45, Bandung'
        ]); 

        Userdetail::create([
            'enablestatus'  => '1',
            'user_id'       => '2',
            'userlevel_id'  => '1',
            'photo'         => '',
            'telp'          => '',
            'birth'         => '1985-07-12',
            'address'       => 'Jl. ABC no.45, Bandung'
        ]); 

        Userdetail::create([
            'enablestatus'  => '1',
            'user_id'       => '3',
            'userlevel_id'  => '2',
            'photo'         => '',
            'telp'          => '',
            'birth'         => '1990-11-23',
            'address'       => 'Jl. QWERTY no.45, Bandung'
        ]);

        Userdetail::create([
            'enablestatus'  => '1',
            'user_id'       => '4',
            'userlevel_id'  => '2',
            'photo'         => '',
            'telp'          => '',
            'birth'         => '1992-07-23',
            'address'       => 'Jl. ASD no.45, Bandung'
        ]); 

        // categories table
        Category::create([
            'category'   => 'fiqih', // id = 1
            'desc'          => ''
        ]);

        Category::create([
            'category'   => 'hadits', // id = 2
            'desc'          => ''
        ]);

        Category::create([
            'category'   => 'finance', // id = 3
            'desc'          => ''
        ]);

        Category::create([
            'category'   => 'science', // id = 4
            'desc'          => ''
        ]);

        Category::create([
            'category'   => 'culinary', // id = 5
            'desc'          => ''
        ]);

        Category::create([
            'category'   => 'tafsir', // id = 6
            'desc'          => ''
        ]);

        Category::create([
            'category'   => 'other', // id = 7
            'desc'          => ''
        ]);

        // articles table
        Article::create([ // id = 1
            'title'         => 'Judul Utama 1',
            'category_id'   => '1',
            'slug'          => 'judul-utama-1',
            'excerpt'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae laudantium, nulla expedita quis accusantium quod delectus dignissimos sunt id laborum?',
            'body'          => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi consequuntur est vitae iusto similique. Velit ut quia suscipit optio, voluptatibus, distinctio recusandae corporis alias esse, eveniet voluptas blanditiis animi ipsam impedit beatae eos placeat a quisquam! Voluptates obcaecati, sequi sed error nulla nam quaerat quibusdam dolores, molestias necessitatibus fugiat et perferendis incidunt praesentium cupiditate earum alias ex! Laudantium, officiis! Esse modi ad dicta fuga pariatur ipsa rerum accusamus libero ullam hic quod nostrum corporis debitis ipsam, nisi laudantium repudiandae. Repudiandae deserunt inventore soluta commodi nihil aliquid voluptatibus doloremque dolor nemo sit! Necessitatibus aspernatur quia quo. Officiis, quia maxime. Voluptates, nesciunt!',
            'statusenable'  => '1',
            'imagetitle'    => '',
            'image1'    => '',
            'image2'    => '',
            'image3'    => ''
        ]);

        Article::create([ // id = 2
            'title'         => 'Judul Utama 2',
            'category_id'   => '2',
            'slug'          => 'judul-utama-2',
            'excerpt'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae laudantium, nulla expedita quis accusantium quod delectus dignissimos sunt id laborum?',
            'body'          => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi consequuntur est vitae iusto similique. Velit ut quia suscipit optio, voluptatibus, distinctio recusandae corporis alias esse, eveniet voluptas blanditiis animi ipsam impedit beatae eos placeat a quisquam! Voluptates obcaecati, sequi sed error nulla nam quaerat quibusdam dolores, molestias necessitatibus fugiat et perferendis incidunt praesentium cupiditate earum alias ex! Laudantium, officiis! Esse modi ad dicta fuga pariatur ipsa rerum accusamus libero ullam hic quod nostrum corporis debitis ipsam, nisi laudantium repudiandae. Repudiandae deserunt inventore soluta commodi nihil aliquid voluptatibus doloremque dolor nemo sit! Necessitatibus aspernatur quia quo. Officiis, quia maxime. Voluptates, nesciunt!',
            'statusenable'  => '1',
            'imagetitle'    => '',
            'image1'    => '',
            'image2'    => '',
            'image3'    => ''
        ]);

        Article::create([ // id =3
            'title'         => 'Judul Utama 3',
            'category_id'   => '3',
            'slug'          => 'judul-utama-3',
            'excerpt'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae laudantium, nulla expedita quis accusantium quod delectus dignissimos sunt id laborum?',
            'body'          => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi consequuntur est vitae iusto similique. Velit ut quia suscipit optio, voluptatibus, distinctio recusandae corporis alias esse, eveniet voluptas blanditiis animi ipsam impedit beatae eos placeat a quisquam! Voluptates obcaecati, sequi sed error nulla nam quaerat quibusdam dolores, molestias necessitatibus fugiat et perferendis incidunt praesentium cupiditate earum alias ex! Laudantium, officiis! Esse modi ad dicta fuga pariatur ipsa rerum accusamus libero ullam hic quod nostrum corporis debitis ipsam, nisi laudantium repudiandae. Repudiandae deserunt inventore soluta commodi nihil aliquid voluptatibus doloremque dolor nemo sit! Necessitatibus aspernatur quia quo. Officiis, quia maxime. Voluptates, nesciunt!',
            'statusenable'  => '1',
            'imagetitle'    => '',
            'image1'    => '',
            'image2'    => '',
            'image3'    => ''
        ]);

        Article::create([ // id = 4
            'title'         => 'Judul Utama 4',
            'category_id'   => '4',
            'slug'          => 'judul-utama-4',
            'excerpt'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae laudantium, nulla expedita quis accusantium quod delectus dignissimos sunt id laborum?',
            'body'          => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi consequuntur est vitae iusto similique. Velit ut quia suscipit optio, voluptatibus, distinctio recusandae corporis alias esse, eveniet voluptas blanditiis animi ipsam impedit beatae eos placeat a quisquam! Voluptates obcaecati, sequi sed error nulla nam quaerat quibusdam dolores, molestias necessitatibus fugiat et perferendis incidunt praesentium cupiditate earum alias ex! Laudantium, officiis! Esse modi ad dicta fuga pariatur ipsa rerum accusamus libero ullam hic quod nostrum corporis debitis ipsam, nisi laudantium repudiandae. Repudiandae deserunt inventore soluta commodi nihil aliquid voluptatibus doloremque dolor nemo sit! Necessitatibus aspernatur quia quo. Officiis, quia maxime. Voluptates, nesciunt!',
            'statusenable'  => '1'
        ]);

        // article_user_links 
        ArticleUserLink::create([
            'article_id' => '1',
            'user_id'    => '1 ' // user_id penulis
        ]);
        
        ArticleUserLink::create([
            'article_id' => '2',
            'user_id'    => '2' // user_id penulis
        ]);
        
        ArticleUserLink::create([
            'article_id' => '3',
            'user_id'    => '3' // user_id penulis
        ]);

        ArticleUserLink::create([
            'article_id' => '4',
            'user_id'    => '3' // user_id penulis
        ]);

        ArticleUserLink::create([
            'article_id' => '4',
            'user_id'    => '4' // user_id penulis
        ]);

        // publish_permissions table
        PublishPermission::create([
            'publish_at'        => '2022-06-08 10:30:50',
            'status_permission' => 'publish',
            'desc'              => '',
            'article_id'        => '1',
            'user_id'           => '1'
        ]);

        PublishPermission::create([
            'publish_at'        => '2022-06-09 11:30:50',
            'status_permission' => 'rejected',
            'desc'              => '',
            'article_id'        => '2',
            'user_id'           => '1'
        ]);

        PublishPermission::create([
            'publish_at'        => '2022-06-10 12:30:50',
            'status_permission' => 'idle',
            'desc'              => '',
            'article_id'        => '3',
            'user_id'           => '3'
        ]);

        PublishPermission::create([
            'publish_at'        => '2022-06-11 12:30:50',
            'status_permission' => 'publish',
            'desc'              => '',
            'article_id'        => '4',
            'user_id'           => '2'
        ]);
    }
}

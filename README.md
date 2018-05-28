# Alice
## Description

This repository is a Application software with PHP, Codeigniter and MYSQL, this application contains a simple Blog.

## Installation
Using PHP7 and Codeigniter 3.x preferably.

## Usage
```html
$ git clone https://github.com/DanielArturoAlejoAlvarez/Alice.git [NAME APP] 
```
Follow the following steps and you're good to go! Important:


![alt text](https://mattstauffer.com/assets/images/content/allautocomplete.gif)


## Coding

### Urls
```apache
RewriteEngine on
RewriteCond $1 !^(index\.php|assets|images|js|css|uploads|favicon.png)
RewriteCond %(REQUEST_FILENAME) !-f
RewriteCond %(REQUEST_FILENAME) !-d
RewriteRule ^(.*)$ ./index.php/$1 [L]

```

```php
...
$route['posts/postsByCategory']='posts/postsByCategory';
$route['posts/search_keyword']='posts/search_keyword';
$route['posts/index']='posts/index';
$route['posts']='posts/index';
$route['posts/create']='posts/create';
$route['posts/update']='posts/update';
$route['posts/(:any)']='posts/show/$1';
...

```

### Controllers


```php

...
 public function index($offset=0){
            //PAGINATION///////////////////////////////////////////////////
            $this->load->library('pagination');
            $config['base_url'] = base_url().'posts/index/';
            $config['total_rows'] = $this->db->count_all('posts');
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $config['attributes']=array('class'=>'pagination-link');
            $this->pagination->initialize($config); 
            ///////////////////////////////////////////////////////////////
            
            $data["title"]="Latest Post";
            
            $data["posts"]=$this->Post_model->getPosts(FALSE, $config['per_page'], $offset);
            
            
            $this->load->view("templates/header.php");
            $this->load->view("posts/index",$data);
            $this->load->view("templates/footer.php");
        }
...

```


### Views

```php
...
<div class="clearfix"></div>
<h1><?= $title; ?></h1>
<h3>TOTAL: <?php echo $counters;?> posts</h3>
<h4>KEYWORD: <span class="be-red"><?php echo $_POST["keyword"];?></h4>
<?php if($results):?>
    <div class="row">
        <?php
        foreach ($results as $row): 
            $date=Date("jS \of F Y",strtotime($row->created_at));
        ?>
        <div class="col-md-4">
            <div class="clearfix"></div>
            <div class="card">
                <div class="card-body">
                    <a href="<?= site_url('/posts/'.$row->slug);?>"><img class="card-img-top" src="<?= site_url('/uploads/posts/'.$row->picture);?>" alt="Card image cap"></a>
                    <h3 class="card-title upper"><a href="<?= site_url('/posts/'.$row->slug);?>"><?= $row->title;?></a></h3>
                </div>
            </div>
        </div>
        
        <?php endforeach; ?>
        
        
    </div>
<?php else:?>
    <h5>No data was found about the word <span class="be-red"><?php echo $_POST["keyword"];?></span>, please try again with another word!</h5>
<?php endif;?>
...
```

### Model

```php
...
if($slug===FALSE){
                $this->db->order_by('p.idpost','DESC');
                $this->db->where('p.state',1); 
                
                //$this->db->select('p.idpost,p.categories_idcategory,p.users_iduser,p.title,p.slug,p.body,p.picture,p.created_at,p.state,u.name,c.idcategory,c.category,GROUP_CONCAT(t.tag SEPARATOR ",") as mytags');
                
                $this->db->select('p.title,p.slug,p.picture,p.created_at,u.name,c.idcategory,c.category,GROUP_CONCAT(t.tag SEPARATOR ",") as mytags');
                $this->db->from('posts p');
              
                $this->db->join('categories c','c.idcategory=p.categories_idcategory');
                $this->db->join('users u','u.iduser=p.users_iduser');

                
                $this->db->join('posts_tags pt','pt.posts_titlepost=p.title');
                $this->db->join('tags t','t.idtag=pt.tags_idtag');
                $this->db->group_by('p.idpost');

                $this->db->order_by('p.idpost','DESC');
                $query=$this->db->get();
                return $query->result_array();




            }
...
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/DanielArturoAlejoAlvarez/Alice. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.


## License

The gem is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).
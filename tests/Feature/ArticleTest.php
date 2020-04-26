<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
Use App\Article;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->article = factory(Article::class)->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_shows_a_collection_of_articles()
    {
        $this->json('GET', '/api/articles')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $this->article->id,
                        'attributes' => [
                            'title' => $this->article->title,
                            'description' => $this->article->content,
                            'picture' => $this->article->thumbnail,
                            'created_at' => $this->article->created_at->diffForHumans(),
                        ]
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_shows_an_article()
    {
        $this->json('GET', "/api/articles/{$this->article->slug}")
            ->assertStatus(200)
            ->assertJson([
                'id' => $this->article->id,
                'attributes' => [
                    'title' => $this->article->title,
                    'description' => $this->article->content,
                    'picture' => $this->article->thumbnail,
                    'created_at' => $this->article->created_at->diffForHumans(),
                ]
            ]);
    }

    /** @test */
    public function it_creates_a_single_article()
    {
        $this->assertEquals(1, Article::count());

        $data = [
            'title' => 'lorem insu dolor',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and',
            'thumbnail' => 'https://picsum.photos/250/250',
        ];

        $this->json('POST', '/api/articles', $data)
            ->assertStatus(201);

        $this->assertEquals(2, Article::count());
    }

    /** @test */
    public function it_deletes_an_article()
    {
        $this->json('DELETE', "/api/articles/{$this->article->slug}")
            ->assertStatus(204);

        $this->assertNull(Article::find($this->article->id));
    }
}

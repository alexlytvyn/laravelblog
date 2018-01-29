<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Article;
use App\Models\Category;
use App\Models\CategoryArticle;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    public function index()
    {
        $objArticle = new Article();
        $articles = $objArticle->get();
        return view('admin.articles.index', ['articles' => $articles]);
    }

    public function viewArticle(int $id)
    {
        $article = Article::find($id);
        return view('admin.articles.view', ['article' => $article]);
    }

    public function addArticle()
    {
        $objCategory = new Category();
        $categories = $objCategory->get();
        return view('admin.articles.add', ['categories' => $categories]);
    }

    public function addRequestArticle(ArticleRequest $request)
    {
        $objArticle = new Article();
        $objCategoryArticle = new CategoryArticle();

        $textFull = $request->input('text_full') ?? null;

        $objArticle = $objArticle->create([
                'title' => $request->input('title'),
                'text_short' => $request->input('text_short'),
                'text_full' => $textFull,
                'author' => $request->input('author')
            ]);

        if ($objArticle) {
            foreach ($request->input('categories') as $category_id) {
                $category_id = (int)$category_id;
                $objCategoryArticle = $objCategoryArticle->create([
                        'category_id' => $category_id,
                        'article_id' => $objArticle->id
                    ]);
            }
            return redirect(route('articles'))->with('success', 'The Article is successfully added!');
        } else {
            return back()->with('error', 'The Article was not added!');
        }
    }

    public function editArticle(int $id)
    {
        $objCategory = new Category();
        $categories = $objCategory->get();
        $objArticle = Article::find($id);
        if (!$objArticle) {
            return abort(404);
        }

				$mainCategories = $objArticle->categories;
				$arrCategories = [];
				foreach ($mainCategories as $category) {
					$arrCategories[] = $category->id;
				}

        return view('admin.articles.edit', [
                'categories' => $categories,
                'article' => $objArticle,
								'arrCategories' => $arrCategories
            ]);
    }

    public function editRequestArticle(ArticleRequest $request, int $id)
    {
        $objArticle = Article::find($id);
        if (!$objArticle) {
            return abort(404);
        }

				$objArticle->title = $request->input('title');
				$objArticle->text_short = $request->input('text_short');
				$objArticle->text_full = $request->input('text_full');
				$objArticle->author = $request->input('author');

				if ($objArticle->save()) {
						// Оновлюємо прив'язку до категорії
						$objArticleCategory = new CategoryArticle();
						$objArticleCategory->where('article_id', $objArticle->id)->delete();

						$arrCategories = $request->input('categories');
						if (is_array($arrCategories)) {
							foreach ($arrCategories as $category) {
								$objArticleCategory->create([
									'category_id' => $category,
									'article_id' => $objArticle->id
								]);
							}
						}
						return redirect(route('articles'))->with('success', 'The Article was edited successfully!');
				} else {
						return back()->with('error', 'The Article was not edited!');
				}
    }

    public function deleteArticle(Request $request)
    {
        if ($request->ajax()) {
            $id = (int)$request->input('id');
            $objArticle = new Article();
            $objArticle->where('id', $id)->delete();
            echo "Successful deleting!";
        }
    }
}

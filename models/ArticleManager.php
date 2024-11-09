<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles() : array
    {
        $sql = "SELECT * FROM article";
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }
    
    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id) : ?Article
    {
        $sql = "SELECT * FROM article WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article) : void 
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article) : void
    {
        $sql = "INSERT INTO article (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article) : void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId()
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id) : void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Modifie le nombre de vues d'un article
     * @param Article $article : l'article à modifier
     * @return void
     */
    public function addVues(Article $article) : void
    {
        $sql = 'UPDATE article SET nombre_vues = :nombres_vues WHERE id = :id';
        $this->db->query($sql, [
            'nombres_vues' => $article->getNombreVues(),
            'id' => $article->getId(),
        ]);
    }

    /**
     * Récupère les infos du tableau trié
     * @param string $categorie : la catégorie que l'ont tri
     * @param string $categorie : l'ordre selon lequel on tri le tableau (croissant ou décroissant)
     * @return array : les informations récupérer par la requete sql
     */
    public function getArticleTri(string $categorie, string $ordre) : array
    {
        $sql = 'SELECT DISTINCT article.id, title, article.date_creation, nombre_vues, COUNT(comment.id) OVER(PARTITION by article.id) as nombre_commentaires
                FROM article LEFT JOIN comment ON article.id = comment.id_article';

        if ($categorie != "" && $ordre != "" && $categorie )
        {
            if ($ordre == 'croissant')
            {
                $sql = $sql . ' ORDER BY ' . $categorie . ' ASC';
            } 
            else if ($ordre == 'decroissant')
            {
                $sql = $sql . ' ORDER BY ' . $categorie . ' DESC';
            }
        }      

        $result = $this->db->query($sql);
        $articles = [];

        while ($res = $result->fetch()) {
            $nbComment = $res['nombre_commentaires'];
            $article = new Article($res);
            $dataArray = array('article' => $article, 'nombre_commentaires' => $nbComment);
            array_push($articles, $dataArray);
        }
        return $articles;
    }
}
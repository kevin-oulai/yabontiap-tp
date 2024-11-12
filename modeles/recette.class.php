

<?php
/**
 * @file recette.class.php
 * @author Antoine Moulin
 * @brief Definit une classe permettant de representer une Recette avec
 * ses IngredientQuantifie et sa Categorie
 * @version 1.0.0
 * @date 02/09/2024
 */

 /**
  * @brief Classe pour representer une recette de cuisine
  */
class Recette
{
    /**
     *
     * @var integer|null L'identifiant de la recette
     */
    private int|null $id;
    /**
     *
     * @var string|null Nom de la recette
     */
    private string|null $nom;
    private string|null $description;
    private string|null $image;
    private ?Categorie $categorie;
    private ?array $ingredientQuantifies; //[objet ingrédient_quantifié],

    /**
     * Constructeur de la classe Recette
     *
     * @param integer|null $id Identifiant de la recette a construire
     * @param string|null $nom Nom de la recette
     * @param string|null $description Description de la recette
     * @param string|null $image
     * @param Categorie|null $categorie Categorie à laquelle apartient la recette : Entree, Plat, Dessert
     * @param array|null $ingredientQuantifies  Les ingredients à utiliser ainsi que leur quantité
     */
    public function __construct(?int $id = null, ?string $nom = null, ?string $description = null, ?string $image = null, ?Categorie $categorie = null, ?array $ingredientQuantifies = null)
    {
        $this->setId($id);
        $this->setNom($nom);
        $this->setDescription($description);
        $this->setImage($image);
        $this->setCategorie($categorie);
        $this->setIngredientQuantifies($ingredientQuantifies);
    }

    /**
     * 
     *
     * @return integer|null Retourne l'identifiant de la recette
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }

    public function getIngredientQuantifies(): ?array
    {
        if ($this->ingredientQuantifies == null)
        {
            $db = Bd::getInstance();
            $pdo = $db->getConnection();
            $manager = new IngredientQuantifieDao($pdo);
            $this->ingredientQuantifies = $manager->findIngredientQuantifieByRecette($this->id);
        }
        return $this->ingredientQuantifies;
    }

    public function setIngredientQuantifies(?array $ingredientQuantifies): void
    {
        $this->ingredientQuantifies = $ingredientQuantifies;
    }
}

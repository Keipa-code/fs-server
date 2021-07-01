<?php

declare(strict_types=1);


namespace App\Upload\Command\FindFiles;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4, allowEmptyString=true)
     * @Assert\Choice({"ASC", "DESC"}, message="Wrong value in sort.")
     */
    public string $order = '';
    /**
     * @Assert\Length(max=20, allowEmptyString=true)
     */
    public string $sort = '';
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/\d/")
     * @Assert\Length(max=1000, allowEmptyString=true)
     */
    public int $pageNumber = 1;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/\d/")
     */
    public int $rowCount = 20;
    /**
     * @Assert\Length(max=30, allowEmptyString=true)
     */
    public string $query = '';

    public function writeData($data) {
        $this->query = $data['search'] ?? '';
        $this->order = $data['order'] ?? 'DESC';
        $this->sort = $data['sort'] ?? 'date';
        $this->pageNumber = (int)$data['pageNumber'] ?? 1;
        $this->rowCount = (int)$data['rowCount'] ?? 20;
    }
}
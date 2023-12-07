<?php


//namespace models;

class Client
{
    /**
     * @var int
     */
    private int $client_id;
    /**
     * @var string
     */
    private string $first_name;
    /**
     * @var string
     */
    private string $last_name;
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $birth_date, $city;
    /**
     * @var string
     */


    public function __construct(int $client_id, string $first_name, string $last_name, string $email, string $birth_date, string $city)
    {
        $this->client_id = $client_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->birth_date = $birth_date;
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->client_id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }
    /**
     * @var string
     */

    /**
     * @param int $client_id
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param int $birth_date
     * @param string $city
     */

}
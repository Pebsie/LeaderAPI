# LeaderAPI
An API built in PHP for tracking online leaderboards. 

## Usage

### POST 'get'
Returns scoreboard info.
Takes 3 parameters:

Title | Type | Description
--- | --- | ---
scoreboard | text | The reference to the scoreboard. This can be any value.
limit | number | the number of results to return
upper | number | the position to count down from. E.G to get users between position 10 and 20 you’d use `{‘upper’:10,’limit’:10}`

#### Example Request
```
{
  scoreboard: 'DogContest',
  upper: 1,
  limit: 100
}
```

#### Example Response: Success
```
{
  ok: true,
  data: [
    {
      id: 10,
      reference: 'DogContest',
      player: 'Buddy',
      score: 100,
      uniqueId: 'bud-2020'
    },
    {
      id: 6,
      reference: 'DogContest',
      player: 'Dexter',
      score: 98,
      uniqueId: 'dex-2020'
    },
  ]
}
```

### POST 'update'
Adds an entry to the database.
Takes 3 parameters:

Title | Type | Description
--- | --- | ---
scoreboard | text | The reference to the scoreboard. This can be any value.
player | text | The name of the player
score | number | The player's score for this entry
uniqueId | text | A unique reference for this entry allowing retrieval

#### Example Request
```
{
  scoreboard: 'DogContest',
  player: "Buddy",
  score: 100,
  uniqueId: "bud-2020"
}
```

#### Example Response: Success
```
{
  ok: true,
  position: 1
}
```

export const data = [
  {
    id: 0,
    teams: [
      {
        id: 1,
        name: 'Yankees',
        logo: 'tbd path'
      },
      {
        id: 2,
        name: 'Nationals',
        logo: `path tbd`,
      }
    ],
    winnerId: 1,
    viewType: 'in-person', // this will eventually become an enum/int
    date: Date.now(),
    scoringType: 'personal', // this will eventually become an enum/int

  },
  {
    id: 1,
    teams: [
      {
        id: 2,
        name: 'Nationals',
        logo: 'tbd path'
      },
      {
        id: 3,
        name: 'Mets',
        logo: 'tbd path',
      }
    ],
    winnerId: 2,
    viewType: 'television', // this will eventually become an enum/int
    date: Date.now(),
    scoringType: 'official', // this will eventually become an enum/int

  },
  {
    id: 2,
    teams: [
      {
        id: 4,
        name: 'Rays',
        logo: 'tbd path'
      },
      {
        id: 5,
        name: 'Blue Jays',
        logo: 'tbd path',
      }
    ],
    winnerId: 5,
    viewType: null, // this will eventually become an enum/int
    date: Date.now(),
    scoringType: 'personal', // this will eventually become an enum/int

  }
];
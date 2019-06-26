export const games = [
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
        logo: 'path tbd',
      }
    ],
    winnerId: 1,
    viewType: {
      id: 1,
      type: 'in-person'
    }, // this will eventually become an enum/int
    date: Date.now(),
    scoringType: {
      id: 2,
      type: 'personal'
    }, // this will eventually become an enum/int
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
        logo: 'tbd path'
      }
    ],
    winnerId: 2,
    viewType: {
      id: 3,
      type: 'radio'
    },  // this will eventually become an enum/int
    date: Date.now(),
    scoringType: {
      id: 1,
      type: 'official'
    }, // this will eventually become an enum/int

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
    viewType: {
      id: 4,
      type: 'other'
    }, // this will eventually become an enum/int
    date: Date.now(),
    scoringType: {
      id: 2,
      type: 'personal'
    }, // this will eventually become an enum/int

  }
];

export const viewingTypes = [
  {
    id: 1, 
    type: 'in-person'
  },
  {
    id: 2, 
    type: 'television'
  },
  {
    id: 3, 
    type: 'radio'
  },
  {
    id: 4, 
    type: 'other'
  },

]

export const teams = [
  {
    id: 1,
    name: 'Yankees',
    logo: 'tbd path'
  },
  {
    id: 2,
    name: 'Nationals',
    logo: `path tbd`,
  },
  {
    id: 3,
    name: 'Mets',
    logo: 'tbd path'
  },
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
]

export const scoringTypes = [
  {
    id: 1,
    type: 'official'
  },
  {
    id: 2,
    type: 'personal'
  }
]
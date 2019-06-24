<template>

  <div>

    <utility-card v-for="game in games" :key="game.id">

      <template slot="content">
        {{`${game.teams[0].name} vs ${game.teams[1].name}`}}
      </template>

      <template slot="bottom">
        viewType: {{game.viewType}}
        Date: {{game.date}}
        scoringType: {{game.scoringType}}
      </template>

    </utility-card>

  </div>

</template>

<script>
import utilityCard from './utility/Card.vue';

export default {
  // currently dummy data that will come from a call to the server
  data() {
    return {
      games: [
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
              logo: 'tbd path',
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
      ]
    }
  },
  mounted() {
    console.log('the games are mounted');
  },
  components: {utilityCard}
}
</script>

<style>

</style>

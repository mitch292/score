<template>
    <div class="mt-4">

        <table class="score-table d-block mx-auto">

            <tr>
                <th>team</th>
                <th v-for="n in getNumberOfInnings(gameData)" :key="n" :class="{'text-red': currentInning === n}">
                    {{ n }}
                </th>
                <th class="text-red">R</th>
                <th>H</th>
                <th>E</th>
                <th>LoB</th>
            </tr>

            <tr>
                <td>{{ awayTeam }}</td>
                <td v-for="n in getNumberOfInnings(gameData)" :key="n">
                    {{ getRuns('away', n) }}
                </td>
                <td class="text-red">{{ gameData.linescore.teams.away.runs }}</td>
                <td>{{ gameData.linescore.teams.away.hits }}</td>
                <td>{{ gameData.linescore.teams.away.errors }}</td>
                <td>{{ gameData.linescore.teams.away.leftOnBase }}</td>
            </tr>
            <tr>
                <td>{{ homeTeam }}</td>
                <td v-for="n in getNumberOfInnings(gameData)" :key="n">
                    {{ getRuns('home', n) }}
                </td>
                <td class="text-red">{{ gameData.linescore.teams.home.runs }}</td>
                <td>{{ gameData.linescore.teams.home.hits }}</td>
                <td>{{ gameData.linescore.teams.home.errors }}</td>
                <td>{{ gameData.linescore.teams.home.leftOnBase }}</td>
            </tr>

        </table>

    </div>

</template>

<script>

    export default {
        props: {
            gameData: Object,
            homeTeam: String,
            awayTeam: String,
        },
        methods: {
            getRuns: function(team, inning) {
                return _.get(this.gameData.linescore.innings, [inning - 1, team, 'runs'], '')
            },
            getNumberOfInnings: function(gameData) {
                return gameData.linescore.innings.length > 9 ? gameData.linescore.innings.length : 9;
            }
        },
        // data() {
        //     return {
        //         currentInning: null,
        //     }
        // },
        computed: {
            currentInning: function() {
                return this.gameData.linescore.currentInning
            }
        }
    }
</script>

<style>

</style>

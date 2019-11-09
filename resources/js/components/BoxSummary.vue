<template>
    <div class="mt-4 row">

        <table class="score-table d-block mx-auto">

            <tr>
                <th>team</th>
                <th v-for="n in getNumberOfInnings(gameData)" :key="n" :class="{'text-red': currentInning === n && gameState !== GAME_IS_FINAL}">
                    {{ n }}
                </th>
                <th :class="{'text-red':gameState !== GAME_IS_FINAL}">R</th>
                <th>H</th>
                <th>E</th>
                <th>LoB</th>
            </tr>

            <tr>
                <td>{{ awayTeam }}</td>
                <td v-for="n in getNumberOfInnings(gameData)" :key="n" :class="{'text-red': currentInning === n && gameData.linescore.isTopInning && gameState !== GAME_IS_FINAL}">
                    {{ getRuns('away', n) }}
                </td>
                <td class="text-red">{{ gameData.linescore.teams.away.runs }}</td>
                <td>{{ gameData.linescore.teams.away.hits }}</td>
                <td>{{ gameData.linescore.teams.away.errors }}</td>
                <td>{{ gameData.linescore.teams.away.leftOnBase }}</td>
            </tr>
            <tr>
                <td>{{ homeTeam }}</td>
                <td v-for="n in getNumberOfInnings(gameData)" :key="n" :class="{'text-red': currentInning === n && !gameData.linescore.isTopInning && gameState !== GAME_IS_FINAL}">
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
            gameStatus: {
				type: Object,
				default: {}
			}
        },
        methods: {
            getRuns: function(team, inning) {
                return _.get(this.gameData.linescore.innings, [inning - 1, team, 'runs'], '')
            },
            getNumberOfInnings: function(gameData) {
                return gameData.linescore.innings.length > 9 ? gameData.linescore.innings.length : 9;
            }
        },
        data() {
            return {
                GAME_IS_FINAL: 'final',
            }
        },
        computed: {
            currentInning: function() {
                return this.gameData.linescore.currentInning
            },
            gameState: function() {
                return _.get(this.gameStatus, ['detailedState'], '').toLowerCase();
            }
        }
    }
</script>

<style>

</style>

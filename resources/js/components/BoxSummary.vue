<template>
    <div class="mt-3">
        <div v-if="gameState" class="row justify-content-center">
            <div class="btn btn-outline-primary--inherit">{{gameState}}</div>
        </div>
        <div class="row mt-3 mb-3">
            <table class="score-table d-block mx-auto">

                <tr>
                    <th>team</th>
                    <th v-for="n in getNumberOfInnings(game)" :key="n" :class="{'text-red': currentInning === n && gameState !== GAME_IS_FINAL}">
                        {{ n }}
                    </th>
                    <th class="text-red">R</th>
                    <th>H</th>
                    <th>E</th>
                    <th>LoB</th>
                </tr>

                <tr>
                    <td>{{ awayTeam }}</td>
                    <td v-for="n in getNumberOfInnings(game)" :key="n" :class="{'text-red': currentInning === n && game.linescore.isTopInning && gameState !== GAME_IS_FINAL}">
                        {{ getRuns('away', n) }}
                    </td>
                    <td class="text-red">{{ game.linescore.teams.away.runs }}</td>
                    <td>{{ game.linescore.teams.away.hits }}</td>
                    <td>{{ game.linescore.teams.away.errors }}</td>
                    <td>{{ game.linescore.teams.away.leftOnBase }}</td>
                </tr>
                <tr>
                    <td>{{ homeTeam }}</td>
                    <td v-for="n in getNumberOfInnings(game)" :key="n" :class="{'text-red': currentInning === n && !game.linescore.isTopInning && gameState !== GAME_IS_FINAL}">
                        {{ getRuns('home', n) }}
                    </td>
                    <td class="text-red">{{ game.linescore.teams.home.runs }}</td>
                    <td>{{ game.linescore.teams.home.hits }}</td>
                    <td>{{ game.linescore.teams.home.errors }}</td>
                    <td>{{ game.linescore.teams.home.leftOnBase }}</td>
                </tr>

            </table>

        </div>
    </div>
</template>

<script>

    export default {
        props: {
            game: Object,
            homeTeam: String,
            awayTeam: String,
            gameStatus: {
				type: Object,
				default: () => ({})
			}
        },
        methods: {
            getRuns: function(team, inning) {
                return _.get(this.game.linescore.innings, [inning - 1, team, 'runs'], '')
            },
            getNumberOfInnings: function(game) {
                return game.linescore.innings.length > 9 ? game.linescore.innings.length : 9;
            }
        },
        data() {
            return {
                GAME_IS_FINAL: 'final',
            }
        },
        computed: {
            currentInning: function() {
                return this.game.linescore.currentInning
            },
            gameState: function() {
                return _.get(this.gameStatus, ['detailedState'], '').toLowerCase();
            }
        }
    }
</script>

<style>

</style>

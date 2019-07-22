<template>
    <div class="mt-4">

        <table class="score-table">

            <tr>
                <th>team</th>
                <th>errors</th>
                <th>LoB</th>
                <th>hits</th>
                <th class="text-red">runs</th>
            </tr>

            <tr>
                <td>{{ homeTeam }}</td>
                <td>{{ gameData.linescore.teams.home.errors }}</td>
                <td>{{ gameData.linescore.teams.home.leftOnBase }}</td>
                <td>{{ gameData.linescore.teams.home.hits }}</td>
                <td class="text-red">{{ gameData.linescore.teams.home.runs }}</td>
            </tr>

            <tr>
                <td>{{ awayTeam }}</td>
                <td>{{ gameData.linescore.teams.away.errors }}</td>
                <td>{{ gameData.linescore.teams.away.leftOnBase }}</td>
                <td>{{ gameData.linescore.teams.away.hits }}</td>
                <td class="text-red">{{ gameData.linescore.teams.away.runs }}</td>
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
    }
</script>

<style>

</style>

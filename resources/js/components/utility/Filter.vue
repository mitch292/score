<template>
  <div>

	<utility-menu>
		<button
			v-for="(item, index) in this.items"
			@click="toggleFilterDisplay" 
			:key="index"
			:name="item.listName"
			class="btn btn-secondary m-4">
			{{item.list.displayName}}
		</button>
	</utility-menu>


	<utility-dropdown
	  v-for="(item, index) in this.displayedItems"
	  :key="index"
	  :items="item.list.content"
	  :keyName="item.keyName"
	  :filter="item.listName"
	  @applyFilter="applyFilter"
	>
	</utility-dropdown>

  </div>
</template>

<script>
import UtilityDropdown from './DropDown.vue'
import UtilityMenu from './Menu.vue';
export default {
	components: {UtilityDropdown, UtilityMenu},
	data() {
		return {
			filterToShow: null,
			appliedFilters: {
				// teams: {},
				// viewingTypes: {},
				// scoringTypes: {}
			}
		}
	},
	props: {
		items: Array,
	},
	computed: {
		displayedItems: function() {
			return this.items.filter(item => item.listName === this.filterToShow)
		}
	},
	methods: {
		toggleFilterDisplay(event) {
			this.filterToShow = this.filterToShow === event.target.name 
				? null 
				: event.target.name;
		},
		applyFilter(filterName, ids) {
			let filters = {}
			ids.forEach(id => {
				filters[id[0]] ? filters[id[0]].push(id[1]) : filters[id[0]] = [id[1]]
			});
			this.appliedFilters = filters;
			// ids.forEach(id => this.appliedFilters[filterName][id] = true);
			this.$emit('newFilter', this.appliedFilters);
		}
	}
}
</script>

<style>

</style>

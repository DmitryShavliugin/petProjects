using Builder_Pattern.Fly;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Builder_Pattern.Ducks
{
    class RubberDuck : DuckBase
    {
        public RubberDuck()
        {
            _flyable = new NoFly();
        }

        public override void Display()
        {
            Console.WriteLine("I'm rubber Duck!");
        }
    }
}
